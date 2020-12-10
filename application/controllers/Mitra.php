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

    public function out()
    {
        $this->mitra->table = 'mitra_out';
        $data['content'] = $this->mitra->get();
        $data['page']    = 'pages/mitra/out';
        $data['title']   = 'Daftar Mitra Out';
        $data['nav_title'] = 'mitra_out';
        $data['title_detail'] = 'Daftar Mitra Out Soraya Bedsheet';

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

    public function edit($id)
    {
        $data['content'] = $this->mitra->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data Tidak ditemukan!');
        }

        if (!$_POST) {
            $data['input']  = $data['content'];
        } else {
            $data['input']  = (object) $this->input->post(null, true);
        }


        if (!$this->mitra->validate()) {
            $data['title']          = 'Edit Mitra';
            $data['sub_title']      = 'This is form add mitra to fill another mitra by admin.';
            $data['nav_title']      = 'mitra';

            $data['form_action']    = base_url("mitra/edit/$id");
            $data['page']           = 'pages/mitra/form';


            $this->view($data);
            return;
        }

        if ($this->mitra->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data has been updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url("mitra"));
    }

    public function delete($id)
    {
        if ($this->mitra->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data has been deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url("mitra"));
    }

    public function showModalToMitraOut($id_mitra)
    {
        $data['mitra'] = $this->mitra->where('id', $id_mitra)->first();

        $data['id_mitra'] = $id_mitra;

        echo show_my_modal('pages/mitra/modal_to_mitra_out', 'modal-to-mitra-out', $data, 'lg');
    }

    public function moveToMitraOut($id_mitra)
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
                'status_nikah'    => $row->status_nikah,
                'status_out'      => $this->input->post('status_out', true),
                'keterangan'      => $this->input->post('keterangan', true)
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

    public function moveToMitra($id_mitra)
    {
        $this->mitra->table = 'mitra_out';
        $mitra              = $this->mitra->where('id', $id_mitra)->get();

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
            if ($this->db->insert_batch('mitra', $data)) {
                $this->mitra->table = 'mitra_out';
                $this->mitra->where('id', $id_mitra)->delete();
                $this->session->set_flashdata('success', 'Mitra telah dimasukkan kembali!');
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

    public function exportToExcel()
    {
        $mitra = $this->mitra->get();
        if ($mitra) {
            include_once APPPATH . '/third_party/xlsxwriter.class.php';
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE);

            $filename = "data-mitra-" . date('d-m-Y-His') . ".xlsx";
            header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');

            $styles = array(
                'widths' => [7, 30, 25, 12, 17, 17, 19, 30, 17, 14, 17],
                'heights' => [21],
                'font' => 'Arial', 'font-size' => 12,
                'font-style' => 'bold',
                'fill' => '#eee',
                'halign' => 'center',
                'border' => 'left,right,top,bottom',
                'border-style'  => 'thin'
            );

            $styles2 = array(
                [
                    'font' => 'Arial', 'font-size' => 11,
                    'halign' => 'left',
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
            );

            $header = array(
                'No'                => 'integer',
                'No Mitra'          => 'string',
                'Nama'              => 'string',
                'Tgl Lahir'         => 'dd/mm/yyyy',
                'Tgl Mulai Kerja'   => 'dd/mm/yyyy',
                'Durasi Kerja'      => 'string',
                'No HP'             => 'string',
                'Alamat'            => 'string',
                'Jenis Kelamin'     => 'string',
                'Tempat'            => 'string',
                'Status'            => 'string',

            );

            $writer = new XLSXWriter();
            $writer->setAuthor('admin');

            $writer->writeSheetHeader('Sheet1', $header, $styles);
            $no = 1;

            foreach ($mitra as $row) {
                $waktuAwal = new DateTime($row->tgl_mulai_kerja . " 00:00:00");
                $waktuSekarang = new DateTime();
                $diff = date_diff($waktuAwal, $waktuSekarang);

                if ($diff->m == 0) {
                    $durasi = 'Kurang dari sebulan';
                } else {
                    $durasi = $diff->m . ' bulan';
                }

                
                $writer->writeSheetRow(
                    'Sheet1',
                    [
                        $no,
                        $row->id,
                        $row->nama,
                        $row->tgl_lahir,
                        $row->tgl_mulai_kerja,
                        $durasi,
                        $row->nohp,
                        $row->alamat,
                        ucwords($row->jenis_kelamin),
                        ucwords($row->tempat),
                        $row->status_nikah == "belum_nikah" ? "Belum Nikah" : ucwords($row->status_nikah)

                    ],
                    $styles2
                );

                $no++;
            }
            $writer->writeToStdOut();
        } else {
            $this->session->set_flashdata('warning', 'Tidak Ada Data!');
            redirect(base_url("mitra"));
        }
    }
}

/* End of file Mitra.php */
