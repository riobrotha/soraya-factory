<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra_model extends MY_Model {

    public $table = 'mitra';
    public function getDefaultValues()
    {
        return [
            'nama'    => '',
            'tgl_lahir'  => '',
            'tgl_mulai_kerja' => '',
            'nohp' => '', 
            'alamat' => '',
            'jenis_kelamin'  => '',
            'tempat'  => '',
            'status_nikah' => '',
           
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'tgl_lahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'tgl_mulai_kerja',
                'label' => 'Tanggal Mulai Kerja',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'nohp',
                'label' => 'No HP',
                'rules' => 'trim|required|numeric'
            ],

            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required'
            ],

           
        ];

        return $validationRules;
    }

}

/* End of file Mitra_model.php */
