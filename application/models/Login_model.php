<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends MY_Model
{

    protected $table    = 'user';

    public function getDefaultValues()
    {
        return [
            'username'     =>  '',
            'password'     =>  '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ],
        ];

        return $validationRules;
    }

    public function run($input)
    {
        $query  = $this->where('username', strtolower($input->username))
            ->where('is_active', 1)
            ->first();

        if (!$query) {
            $this->session->set_flashdata('warning', 'Account not found, please contact admin.');
        }
        
        if (!empty($query) && hashEncryptVerify($input->password, $query->password)) {

            $sess_data = [
                'id'           => $query->id,
                'name'         => $query->nama,
                'username'     => $query->username,
                'password'     => $query->password,
                'role'         => $query->role,
                'image'        => $query->image,
                'is_login'     => true,
            ];

            $this->session->set_userdata($sess_data);
            return true;
        }
        return false;
    }
}

/* End of file Login_model.php */
