<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Store extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role != 'admin') {
            redirect(base_url());
            return;
        } else {
        }

        $this->store->table = 'distribusi';
        $data['content'] = $this->store->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan',
            'mitra.id', 'store.jumlah_store', '(distribusi.jumlah_set - store.jumlah_store) AS sisa_set', 'distribusi.id AS id_distribusi',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->xjoin('store', 'inner')
            ->join('mitrawork')
            ->get();

        foreach ($data['content'] as $row) {
            if ($row->sisa_set != 0) {
                $data_update = array(
                    'status_pekerjaan' => 'proses'
                );
                
                $this->store->where('id', $row->id_distribusi)->update($data_update);
            } else {
                $data_update = array(
                    'status_pekerjaan' => 'selesai'
                );
                
                $this->store->where('id', $row->id_distribusi)->update($data_update);
            }
        }
    }

    public function index()
    {
        $this->store->table = 'progress';
        $data['content'] = $this->store->where('MONTH(tanggal)', date("m"))->get();

        //print_r($data['content']);
        $data['page'] = 'pages/store/index';
        $data['title'] = 'Daftar Penyerahan Pekerjaan';
        $data['nav_title'] = 'store';
        $data['title_detail'] = 'Daftar Penyerahan Pekerjaan';
        //$this->show_table($data);

        $this->view($data);
    }

    public function store_pekerjaan($idProgress)
    {
        $this->store->table = 'distribusi';
        $data['getDistribusi'] = $this->store->select([

            'distribusi.id AS id_distribusi', 'distribusi.id_progress', 'distribusi.jumlah_set', 'mitrawork.nama_mitrawork', 'mitra.nama',
            'distribusi.status_pekerjaan'
        ])->join('mitra')->join('mitrawork')->where('id_progress', $idProgress)
            ->get();

        $data['id'] = $idProgress;

        $this->store->table = 'mitrawork';
        $data['mitrawork'] = $this->store->get();


        $data['page'] = 'pages/store/form_store';
        $data['title'] = 'Form Store Pekerjaan';
        $data['nav_title'] = 'store';

        $this->view($data);
    }

    public function insert_store($id)
    {
        $id_progress    = $this->input->post('id_progress', true);
        $id_distribusi  = $this->input->post('id_distribusi', true);
        $jumlah_store   = $this->input->post('jumlah_store', true);
        $jumlah_set     = $this->input->post('jumlah_set', true);
        $status_pekerjaan  = $this->input->post('status_pekerjaan', true);

        $data = array();
        $data_update = array();

        $i = 0;

        foreach ($id_progress as $row) {

            $this->store->table = 'store';
            $getStore = $this->store->where('distribusi.id_progress', $id)
                ->join('distribusi')
                ->count();

            $id2 = date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1);
            if ($status_pekerjaan[$i] == 'dikerjakan') {
                array_push($data, array(
                    'id'            => $id2,
                    'id_distribusi' => $id_distribusi[$i],
                    'jumlah_store'  => $jumlah_store[$i] >= $jumlah_set[$i] ? $jumlah_set[$i] : $jumlah_store[$i]
                ));
            }

            if ($getStore == 0) {
                $id = date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1);

                if ($jumlah_set[$i] <= $jumlah_store[$i]) {
                    array_push($data_update, array(
                        'id'               => $id_distribusi[$i],
                        'status_pekerjaan' => 'selesai'
                    ));
                } else {
                    array_push($data_update, array(
                        'id'               => $id_distribusi[$i],
                        'status_pekerjaan' => 'proses'
                    ));
                }

                if ($status_pekerjaan[$i] != 'dikerjakan') {
                    array_push($data, array(
                        'id'            => $id,
                        'id_distribusi' => $id_distribusi[$i],
                        'jumlah_store'  => $jumlah_store[$i] >= $jumlah_set[$i] ? $jumlah_set[$i] : $jumlah_store[$i]
                    ));
                }
            } else {
                if ($jumlah_set[$i] <= $jumlah_store[$i]) {
                    array_push($data_update, array(
                        'id'               => $id_distribusi[$i],
                        'status_pekerjaan' => 'selesai'
                    ));
                } else {
                    array_push($data_update, array(
                        'id'               => $id_distribusi[$i],
                        'status_pekerjaan' => 'proses'
                    ));
                }

                $data_update2 = array(
                    'jumlah_store' => $jumlah_store[$i] >= $jumlah_set[$i] ? $jumlah_set[$i] : $jumlah_store[$i]
                );

                $this->store->where('store.id_distribusi', $id_distribusi[$i])
                    ->update($data_update2);
            }


            $i++;
        }


        // print_r($id_progress);
        if (count($data) > 0) {
            if ($this->db->insert_batch('store', $data)) {
                if (count($data_update) > 0) {
                    $this->db->update_batch('distribusi', $data_update, 'id');
                }
                $this->session->set_flashdata('success', 'Data has been saved!');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong!');
            }
        } else {
            $this->db->update_batch('distribusi', $data_update, 'id');
            $this->session->set_flashdata('success', 'Data has been saved!');
        }


        redirect('store');
    }

    public function edit_store_pekerjaan($idProgress)
    {
        $this->store->table = 'distribusi';
        $data['getDistribusi'] = $this->store->select([

            'distribusi.id AS id_distribusi', 'distribusi.id_progress', 'distribusi.jumlah_set', 'mitrawork.nama_mitrawork', 'mitra.nama',
            'distribusi.status_pekerjaan', 'store.jumlah_store', 'store.id AS id_store'
        ])->xjoin('store')->join('mitra')->join('mitrawork')->where('id_progress', $idProgress)
            ->get();

        $data['id'] = $idProgress;

        $this->store->table = 'mitrawork';
        $data['mitrawork'] = $this->store->get();


        $data['page'] = 'pages/store/form_edit_store';
        $data['title'] = 'Form Edit Store Pekerjaan';
        $data['nav_title'] = 'store';

        $this->view($data);
    }

    public function update_store()
    {
        $id_progress    = $this->input->post('id_progress', true);
        $id_distribusi  = $this->input->post('id_distribusi', true);
        $id_store  = $this->input->post('id_store', true);
        $jumlah_store   = $this->input->post('jumlah_store', true);
        $jumlah_set     = $this->input->post('jumlah_set', true);
        $status_pekerjaan  = $this->input->post('status_pekerjaan', true);

        
        $data_update = array();

        $i = 0;

        foreach($id_progress as $row){
            $data_update[] = array(
                'id'            => $id_store[$i],
                'jumlah_store'  => $jumlah_store[$i] > $jumlah_set[$i] ? $jumlah_set[$i] : $jumlah_store[$i]
            );

            $i++;
        }


        if(count($data_update) > 0){
            if ($this->db->update_batch('store', $data_update, 'id')) {
                $this->session->set_flashdata('success', 'Data has been updated!');
                
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong');
                
            }
        } else {
            $this->session->set_flashdata('warning', 'Data has not found');
            
        }

        redirect(base_url('store'));
    }



    public function detail($id)
    {
        $this->store->table = 'distribusi';
        $data['content'] = $this->store->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan',
            'mitra.id', 'store.jumlah_store',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->xjoin('store', 'inner')
            ->join('mitrawork')
            ->where('id_progress', $id)->get();


        // $jumlah = $this->store->select([
        //     'distribusi.jumlah_set', 'store.jumlah_store'
        // ])->get();



        $this->store->table = 'progress';
        $data['progress'] = $this->store->where('id', $id)->first();


        //print_r($data['content']);
        echo show_my_modal('pages/store/modal_detail', 'modal-detail-store', $data, 'lg');
    }

    // public function update_status($id)
    // {
    //     $this->store->table = 'store';
    //     $data['getDistribusi'] = $this->store->select([
    //         'distribusi.jumlah_set', 'store.jumlah_store', 'distribusi.id', 'store.id_distribusi'
    //     ])->join('distribusi')->where('id_progress', $id)->get();

    //     foreach ($data['getDistribusi']  as $row) {
    //         if ($row->jumlah_set == $row->jumlah_store) {
    //             $data = array(
    //                 'distribusi.status_pekerjaan' => 'selesai'
    //             );

    //             $this->store->table = 'distribusi';
    //             $this->store->where('distribusi.id', $row->id_distribusi)->update($data);
    //         } else if ($row->jumlah_set > $row->jumlah_store) {
    //             $data = array(
    //                 'distribusi.status_pekerjaan' => 'proses'
    //             );

    //             $this->store->table = 'distribusi';
    //             $this->store->where('distribusi.id', $row->id_distribusi)->update($data);
    //         } else {
    //             // $data = array(
    //             //     'distribusi.status_pekerjaan' => 'proses'
    //             // );

    //             // $this->store->table = 'distribusi';
    //             // $this->store->where('distribusi.id', $row->id_distribusi)->update($data);
    //         }
    //     }
    // }
}

/* End of file Store.php */
