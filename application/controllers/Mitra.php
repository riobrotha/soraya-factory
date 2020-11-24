<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'admin') {
            // redirect(base_url());
            return;
        } else {
            $this->session->set_flashdata('warning', 'Tidak Mempunyai Akses ke Menu Tersebut');
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['content'] = $this->mitra->get();
        $data['page'] = 'pages/mitra/index';
        $data['title'] = 'Daftar Mitra';
        $data['nav_title'] = 'mitra';
        $data['title_detail'] = 'Daftar Mitra Soraya Bedsheet';
        //$this->show_table($data);

        $this->view($data);
    }



    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->mitra->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        //proses validasi form
        if (!$this->mitra->validate()) {
            $data['title']          = 'Tambah Mitra';
            $data['sub_title']      = 'This is form add mitra to fill another mitra by admin.';
            $data['nav_title']      = 'mitra';
            $data['input']          = $input;
            $data['form_action']    = base_url('mitra/add');
            $data['page']           = 'pages/mitra/form';

            //echo show_my_modal($data['page'], 'modal-add-mitra', $data, 'lg');
            //echo $this->load->view('pages/mitra/form', $data, true);
            $this->view($data);
            return;
        }

        //proses penambahan product dan memasukkannya ke dalam db
        if ($this->mitra->add($input) == true) {
            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('mitra'));

        //echo var_dump($input);

    }
}

/* End of file Mitra.php */
