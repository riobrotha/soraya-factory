<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Progress extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mypdf');

        $role = $this->session->userdata('role');

        if ($role == 'admin' || $role == 'admin_gunting') {
            // redirect(base_url());
            return;
        } else {
            redirect(base_url());
            return;
        }
    }
    public function index()
    {

        $data['content'] = $this->progress->where('MONTH(tanggal)', date("m"))->get();
        $data['page'] = 'pages/progress/index';
        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'progress';
        $data['title_detail'] = 'Daftar Progress';
        //$this->show_table($data);

        $this->view($data);
    }

    public function add()
    {
        //echo $this->codeGenerator();
        if (!$_POST) {
            $input = (object) $this->progress->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        //proses validasi form
        if (!$this->progress->validate()) {
            $data['title']          = 'Tambah Progress';
            $data['id']             = $this->codeGenerator();
            $data['nav_title']      = 'progress';
            $data['input']          = $input;
            $data['form_action']    = base_url('progress/add');
            $data['page']           = 'pages/progress/form';
            $this->view($data);
            return;
        }

        //proses penambahan product dan memasukkannya ke dalam db
        if ($this->progress->add($input) == true) {
            //$this->session->set_flashdata('id_insert', $masuk);
            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('progress'));

        //echo var_dump($input);

    }

    public function add_plan($id = null)
    {
        $data['content'] = $this->progress->where('id', $id)->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Sorry, data not found');
            redirect(base_url('progress'));
        }

        $this->progress->table = 'jenis_pekerjaan';
        $data['jenis_pekerjaan'] = $this->progress->get();
        $data['title'] = 'Tambah Perencanaan';
        $data['nav_title'] = 'progress';
        $data['page'] = 'pages/progress/form_plan';

        $this->view($data);
    }

    public function insert_plan()
    {

        $idProgress = $this->input->post('id_progress', true);
        $idPekerjaan = $this->input->post('id_jenis_pekerjaan', true);
        $idBantal = $this->input->post('id_jenis_bantal', true);
        $kuantitas = $this->input->post('qty', true);
        $data = array();

        $i = 0;
        foreach ($idProgress as $row) {

            $this->progress->table = 'perencanaan';
            $ambilPerencanaan =  $this->progress->where('perencanaan.id_progress', $row)
                ->where('perencanaan.id_jenis_pekerjaan', $idPekerjaan[$i])
                ->where('perencanaan.id_jenis_bantal', $idBantal[$i])
                ->count();

            if ($ambilPerencanaan > 0) {
                $data_update = array(
                    'qty' => $kuantitas[$i]
                );

                $this->progress->where('perencanaan.id_progress', $row)
                    ->where('perencanaan.id_jenis_pekerjaan', $idPekerjaan[$i])
                    ->where('perencanaan.id_jenis_bantal', $idBantal[$i])
                    ->update($data_update);
            } else {
                array_push($data, array(
                    'id_progress' => $row,
                    'id_jenis_pekerjaan' => $idPekerjaan[$i],
                    'id_jenis_bantal' => $idBantal[$i],
                    'qty'   => $kuantitas[$i],
                    'nama_admin' => $this->session->userdata('name')
                ));
            }

            $i++;
        }

        if (count($data) > 0) {
            if ($this->db->insert_batch('perencanaan', $data)) {
                $this->session->set_flashdata('success', 'Data has been saved!');
                redirect('progress');
            }
        } else {
            $this->session->set_flashdata('success', 'Data has been saved!');
            redirect('progress');
        }
    }

    public function cetakPdf($data, $id_progress)
    {
        $this->mypdf->generate('pages/progress/cetak_plan', $data, 'kartu_order_bal_' . $id_progress, 'A4', 'landscape');
    }

    public function loadCetak($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['id_progress'] = $id_progress;
        $data['perencanaan'] = $this->progress->select([
            'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal'
        ])
            ->join('jenis_pekerjaan')
            ->where('perencanaan.id_progress', $id_progress)
            ->get();

        $data['nama_admin'] = $this->progress->select([
            'perencanaan.nama_admin'
        ])
            ->where('perencanaan.id_progress', $id_progress)
            ->first();

        $data['total_love'] = $this->progress->where('perencanaan.id_jenis_bantal', 1)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_bt'] = $this->progress->where('perencanaan.id_jenis_bantal', 2)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_bis'] = $this->progress->where('perencanaan.id_jenis_bantal', 3)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_rc'] = $this->progress->where('perencanaan.id_jenis_bantal', 4)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_dsc'] = $this->progress->where('perencanaan.id_jenis_bantal', 5)->where('perencanaan.id_progress', $id_progress)->get();

        $this->progress->table = 'progress';
        $data['tanggal_progress'] = $this->progress->where('id', $id_progress)->first();

        // $this->cetakPdf($data, $id_progress);
        $this->load->view('pages/progress/cetak_plan', $data);
    }

    public function codeGenerator()
    {
        $noOd                   = getKodeMax();
        $kode = $noOd->NoODMax;
        $blnFromDB = substr($kode, 0, 3);
        $blnNow    = strtoupper(konversiBln(date("M")));

        if ($blnFromDB == $blnNow) {
            if ($kode == '') {
                echo 'kosong';
            } else {
                $urutan = (int) substr($kode, 3, 3);
                $urutan++;

                $bln = strtoupper(konversiBln(date("M")));
                $kodeBaru = $bln . sprintf("%03s", $urutan);
            }
        } else {
            $bln = strtoupper(konversiBln(date("M")));
            $kodeBaru = $bln . '001';
        }

        return $kodeBaru;
    }

    public function realisasi()
    {
        $data['content'] = $this->progress->where('MONTH(tanggal)', date("m"))->get();


        $data['page'] = 'pages/progress/realisasi';
        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'realisasi';
        $data['title_detail'] = 'Daftar Progress';
        //$this->show_table($data);

        $this->view($data);
    }

    public function add_realisasi($id_progress)
    {

        $this->progress->table = 'perencanaan';
        $data['getPerencanaan'] = $this->progress->select([
            'perencanaan.id AS id_perencanaan', 'perencanaan.id_progress',
            'perencanaan.id_jenis_pekerjaan', 'perencanaan.id_jenis_bantal',
            'perencanaan.qty AS kuantitas_rencana', 'perencanaan.id_progress',
            'jenis_pekerjaan.nama_pekerjaan', 'jenis_bantal.nama_jenis_bantal'
        ])
            ->join('jenis_pekerjaan')
            ->join('jenis_bantal')
            ->where('id_progress', $id_progress)
            ->get();

        $data['id'] = $id_progress;
        //print_r($data['getPerencanaan']);

        $data['page']  = 'pages/progress/form_realisasi';
        $data['title'] = 'Form Realisasi Rencana Gunting';
        $data['nav_title'] = 'realisasi';

        $this->view($data);
    }

    public function insert_realisasi($id)
    {
        $id_perencanaan      = $this->input->post('id_perencanaan', true);
        $id_progress         = $this->input->post('id_progress', true);
        $qty                 = $this->input->post('qty', true);
        $kuantitas_rencana   = $this->input->post('kuantitas_rencana', true);

        $data  = array();


        $i = 0;
        foreach ($id_progress as $row) {
            $this->progress->table = 'realisasi';
            $getRealisasi = $this->progress->where('perencanaan.id_progress', $id)
                ->join('perencanaan')
                ->count();



            if ($getRealisasi != 0) {

                $data_update = array(
                    'qty'    => $qty[$i] > $kuantitas_rencana[$i] ? $kuantitas_rencana[$i] : $qty[$i]
                );

                //$this->progress->table = 'realisasi'
                $this->progress->where('id_perencanaan', $id_perencanaan[$i])
                    ->update($data_update);
            } else {
                $id2 = date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1);
                array_push($data, array(
                    'id'             => $id2,
                    'id_perencanaan' => $id_perencanaan[$i],
                    'qty'            => $qty[$i] > $kuantitas_rencana[$i] ? $kuantitas_rencana[$i] : $qty[$i],
                    'nama_admin'     => $this->session->userdata('name')
                ));
            }

            $i++;
        }


        //print_r($data);
        if (count($data) > 0) {
            if ($this->db->insert_batch('realisasi', $data)) {
                $this->session->set_flashdata('success', 'Data has been saved!');
                redirect('progress/realisasi');
            }
        } else {
            $this->session->set_flashdata('success', 'Data has been saved!');
            redirect('progress/realisasi');
        }
    }

    public function preview($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['content'] = $this->progress->select([
            'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal',
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->join('jenis_pekerjaan')
            ->xjoin('realisasi')
            ->where('perencanaan.id_progress', $id_progress)
            ->get();

        //$this->progress->table = 'realisasi';
        $data['nama_admin'] = $this->progress->select([
            'realisasi.nama_admin'
        ])
            ->xjoin('realisasi')
            ->where('perencanaan.id_progress', $id_progress)
            ->first();

        

        //total_perencanaan
        $data['total_love'] = $this->progress->where('perencanaan.id_jenis_bantal', 1)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_bt']   = $this->progress->where('perencanaan.id_jenis_bantal', 2)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_bis']  = $this->progress->where('perencanaan.id_jenis_bantal', 3)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_rc']   = $this->progress->where('perencanaan.id_jenis_bantal', 4)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_dsc']  = $this->progress->where('perencanaan.id_jenis_bantal', 5)->where('perencanaan.id_progress', $id_progress)->get();

        //total_realisasi
        $data['total_love_realisasi'] = $this->progress->select([
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->xjoin('realisasi')
            ->where('perencanaan.id_jenis_bantal', 1)->where('perencanaan.id_progress', $id_progress)->get();

        $data['total_bt_realisasi'] = $this->progress->select([
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->xjoin('realisasi')
            ->where('perencanaan.id_jenis_bantal', 2)->where('perencanaan.id_progress', $id_progress)->get();


        $data['total_bis_realisasi'] = $this->progress->select([
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->xjoin('realisasi')
            ->where('perencanaan.id_jenis_bantal', 3)->where('perencanaan.id_progress', $id_progress)->get();


        $data['total_rc_realisasi'] = $this->progress->select([
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->xjoin('realisasi')
            ->where('perencanaan.id_jenis_bantal', 4)->where('perencanaan.id_progress', $id_progress)->get();


        $data['total_dsc_realisasi'] = $this->progress->select([
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->xjoin('realisasi')
            ->where('perencanaan.id_jenis_bantal', 5)->where('perencanaan.id_progress', $id_progress)->get();



        $this->progress->table = 'progress';
        $data['data_progress'] = $this->progress->where('id', $id_progress)->first();


        $data['page']         = 'pages/progress/preview';
        $data['nav_title']    = 'realisasi';
        $data['title_detail'] = 'Preview';
        $data['id']           = $id_progress;

        $this->view($data);

        //print_r($data['total_love_realisasi']);
    }
}

/* End of file Progress.php */
