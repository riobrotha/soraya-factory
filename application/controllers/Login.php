<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $is_login   = $this->session->userdata('is_login');
        $role = $this->session->userdata('role');

        if ($is_login) {

            if ($role == 'admin') {
                redirect(base_url("home"));
                return;
            } else if ($role == 'admin_gunting') {
                $this->session->set_flashdata('warning', 'Tidak Mempunyai Akses ke Menu Tersebut.');
                redirect(base_url("progress"));
                return;
            } else if ($role == 'admin_distribusi'){
                $this->session->set_flashdata('warning', 'Tidak Mempunyai Akses ke Menu Tersebut');
                redirect(base_url("distribusi"));
                
            } else if ($role == 'admin_store'){
                $this->session->set_flashdata('warning', 'Tidak Mempunyai Akses ke Menu Tersebut');
                redirect(base_url("store"));
                
            }
        }
    }

    public function index()
    {

        //pengecekan ketika request dilakukan melalui method post atau tidak
        if (!$_POST) {
            $input = (object) $this->login->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        //proses validasi form login
        if (!$this->login->validate()) {
            $data['title'] = 'Login';
            $data['input'] = $input;
            $data['page']  = 'pages/auth/login';


            $this->view_auth($data);
            return;
        }

        //jika login berhasil maka akan direct ke halaman admin(jika admin) atau ke halaman depan(jika user)
        if ($this->login->run($input)) {
            $this->session->set_flashdata('success', 'Berhasil melakukan login');
            if ($this->session->userdata('role') == 'admin') {
                redirect(base_url('home'));
            } else if ($this->session->userdata('role') == 'admin_gunting') {
                redirect(base_url('progress'));
            } else {
                redirect(base_url());
            }
        } else { //jika proses login gagal maka direct ke halaman login lagi
            $this->session->set_flashdata('error', 'Username atau Password salah');
            redirect(base_url('login'));
        }
    }





    // public function logoutfb()
    // {
    //     $this->facebook->destroy_session();
    //     redirect(base_url('login'));
    // }
}

/* End of file Login.php */
