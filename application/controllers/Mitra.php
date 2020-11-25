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

    public function moveMitra($id_mitra)
    {

        $mitra = $this->mitra->where('id', $id_mitra)->get();

        $data = array();

        foreach ($mitra as $row) {
            array_push($data, array(
                'id'              => $row->id,
                'nama'            => $row->nama,
                'tgl_lahir'       => $row->tgl_lahir,
                'tgl_mulai_kerja' => $row->tgl_mulai_kerja,
                'nohp'            => $row->nohp,
                'alamat'          => $row->alamat,
                'jenis_kelamin'   => $row->jenis_kelamin,
                'tempat'          => $row->tempat,
                'status_nikah'    => $row->status_nikah
            ));

            
        }

        if (count($data) > 0) {
            // $this->mitra->table = 'mitra_out';
            if ($this->db->insert_batch('mitra_out', $data)) {
                $this->mitra->where('id', $id_mitra)->delete();
                $this->session->set_flashdata('success', 'Mitra telah dikeluarkan!');
                redirect(base_url("mitra"));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                redirect(base_url("mitra"));
            }
        } else {
            $this->session->set_flashdata('warning', 'Tidak ada data');
            redirect(base_url("mitra"));
        }
    }
}

/* End of file Mitra.php */
