<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Distribusi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        $this->load->library('mypdf');

        if ($role == 'admin' || $role == 'admin_distribusi') {
            // redirect(base_url());
             return;
         } else {
             redirect(base_url());
             return;
         }
    }

    public function index()
    {

        $this->distribusi->table = 'progress';
        $data['content'] = $this->distribusi->where('MONTH(tanggal)', date("m"))->get();
        $data['page'] = 'pages/distribusi/index';
        $data['title'] = 'Daftar Pendistribusian';
        $data['nav_title'] = 'distribusi';
        $data['title_detail'] = 'Daftar Pendistribusian';
        //$this->show_table($data);

        $this->view($data);
    }

    public function add_work($id)
    {
        // $data['content'] = $this->distribusi->where('id', $id)->first();
        // if (!$data['content']) {
        //     $this->session->set_flashdata('warning', 'Sorry, data not found');
        //     redirect(base_url('distribusi'));
        // }
        $data['id'] = $id;

        // $this->distribusi->table = 'jenis_pekerjaan';
        //$data['jenis_pekerjaan'] = $this->distribusi->get();
        $data['title'] = 'Tambah Pembagian Kerja';
        $data['nav_title'] = 'distribusi';
        $data['page'] = 'pages/distribusi/form';

        $this->view($data);
    }

    public function insert_work()
    {
        $digits = 4;

        $idProgress = $this->input->post('id_progress', true);
        $idMitra = $this->input->post('id_mitra', true);
        $idMitraWork = $this->input->post('id_mitrawork', true);
        $jumlahSet = $this->input->post('jumlah_set', true);

        $data = array();

        $i = 0;
        foreach ($idProgress as $row) {

            $this->distribusi->table = 'distribusi';
            $getDistribusi = $this->distribusi->where('distribusi.id_progress', $row)
                ->where('distribusi.id_mitra', $idMitra[$i])
                ->where('distribusi.id_mitrawork', $idMitraWork[$i])
                ->count();

            if ($getDistribusi == 0) {
                $id = date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                array_push($data, array(
                    'id'            => $id,
                    'id_progress'   => $row,
                    'id_mitra'      => $idMitra[$i],
                    'id_mitrawork'  => $idMitraWork[$i],
                    'jumlah_set'    => $jumlahSet[$i]
                ));
            } else {
                $data_update = array(
                    'jumlah_set' => $jumlahSet[$i]
                );

                $this->distribusi->where('distribusi.id_progress', $row)
                    ->where('distribusi.id_mitra', $idMitra[$i])
                    ->where('distribusi.id_mitrawork', $idMitraWork[$i])
                    ->update($data_update);
            }

            $i++;
        }

        if (count($data) > 0) {
            if ($this->db->insert_batch('distribusi', $data)) {
                $this->session->set_flashdata('success', 'Data has been saved!');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong!');
            }
        } else {
            $this->session->set_flashdata('success', 'Data has been saved!');
            //redirect('progress');
        }


        redirect('distribusi');
    }

    public function showForm($id_progress)
    {
        $this->distribusi->table = 'mitra';
        $mitra = $this->distribusi->get();

        $this->distribusi->table = 'mitrawork';
        $mitrawork = $this->distribusi->get();
        $option = '';
        $option2 = '';
        foreach ($mitra as $row) {


            $option .= '<option value="' . $row->id . '">' . $row->nama . ' - ' . $row->id . '  </option>';
        }

        foreach ($mitrawork as $row) {

            $option2 .= '<option value="' . $row->id . '">' . $row->nama_mitrawork . '</option>';
        }

        $output = '<input type="hidden" name="id_progress[]" value="' . $id_progress . '">
                        <div class="col-xs-4" style="margin-top: 20px;">
                            <h2 class="card-inside-title"> Jenis Pekerjaan</h2>
                            <select class="form-control show-tick select2" name="id_mitrawork[]">
                            <option></option>
                            ' . $option2 . '
                            </select>
                        </div>
                        <div class="col-xs-4" style="margin-top: 20px;">
                            <h2 class="card-inside-title">Mitra</h2>
                            <select class="form-control show-tick select2" name="id_mitra[]">
                            <option></option>
                            ' . $option . '
                            
                            </select>
                            
                        </div>
                        <div class="col-xs-4" style="margin-top: 20px;">
                            <h2 class="card-inside-title">Jumlah Set</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="jumlah_set[]" required />
                                </div>

                            </div>
                        </div>
                        
            
            ';

        echo $output;
    }

    public function detail($id)
    {
        $data['content'] = $this->distribusi->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan',
            'mitra.id',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->join('mitrawork')
            ->where('id_progress', $id)->get();


        $this->distribusi->table = 'progress';
        $data['progress'] = $this->distribusi->where('id', $id)->first();

        //print_r($data['content']);
        echo show_my_modal('pages/distribusi/modal_detail', 'modal-detail-distribusi', $data, 'lg');
    }

    public function cetakPdf($data, $id_progress)
    {
        $this->mypdf->generate('pages/distribusi/cetak_kartu', $data, 'kartu_order_bal_v2' . $id_progress, 'A4', 'portrait');
    }

    public function loadCetak($id_progress)
    {
        $this->distribusi->table = 'perencanaan';
        $data['id_progress'] = $id_progress;

        $data['perencanaan'] = $this->distribusi->select([
            'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal'
        ])
            ->join('jenis_pekerjaan')
            ->where('perencanaan.id_progress', $id_progress)
            ->get();

        $data['total_love'] = $this->distribusi->where('perencanaan.id_jenis_bantal', 1)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_bt']   = $this->distribusi->where('perencanaan.id_jenis_bantal', 2)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_bis']  = $this->distribusi->where('perencanaan.id_jenis_bantal', 3)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_rc']   = $this->distribusi->where('perencanaan.id_jenis_bantal', 4)->where('perencanaan.id_progress', $id_progress)->get();
        $data['total_dsc']  = $this->distribusi->where('perencanaan.id_jenis_bantal', 5)->where('perencanaan.id_progress', $id_progress)->get();

        $this->distribusi->table = 'progress';
        $data['tanggal_progress'] = $this->distribusi->where('id', $id_progress)->first();

        $this->distribusi->table = 'distribusi';
        $data['distribusi'] = $this->distribusi->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan',
            'mitra.id',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->join('mitrawork')
            ->where('id_progress', $id_progress)->get();

        $this->load->view('pages/distribusi/cetak_kartu', $data);
    }
}

/* End of file Distribusi.php */
