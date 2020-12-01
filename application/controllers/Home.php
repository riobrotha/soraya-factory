<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
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

        //total progress
        $this->home->table = 'progress';
        $data['countProgress'] = $this->home->where('MONTH(tanggal)', date("m"))->count();

        //total distribusi
        $this->home->table = 'distribusi';
        $data['countDist']     = $this->home->select([
            'distribusi.jumlah_set', 'progress.tanggal'
        ])
            ->join('progress')
            ->where('MONTH(distribusi.created_at)', date("m"))
            ->get();

        //total store
        $this->home->table = 'store AS s';
        $data['countStore'] = $this->home->select([
            's.jumlah_store', 'progress.tanggal'
        ])
            ->join('distribusi')
            ->joinAlt2('progress', 'distribusi')
            ->where('MONTH(s.created_at)', date("m"))
            ->get();

        //total mitra
        $this->home->table = 'mitra';
        $data['countMitra'] = $this->home->count();


        //rank mitra
        $data['rankMitra'] = $this->home->select([
            'mitra.id', 'mitra.nama',
            'SUM(store.jumlah_store) AS jumlah_store',
            'SUM(distribusi.jumlah_set) AS jumlah_set', '(SUM(distribusi.jumlah_set) - SUM(store.jumlah_store)) AS belum_selesai'
        ])
            ->xjoin('distribusi')
            ->joinAlt('store', 'distribusi')
            ->where('MONTH(store.created_at)', date("m"))
            ->orderBy('belum_selesai')
            ->groupBy('mitra.id')
            ->limit(5)
            ->get();

        $data['page'] = 'pages/home/index';
        $data['title'] = 'Dashboard';
        $data['nav_title'] = 'home';
        $this->view($data);
    }

    public function requestProgressChart()
    {
        $this->home->table = 'distribusi';

        for ($i = 1; $i <= 12; $i++) {
            $data['proses' . $i]    = $this->home->select([
                'SUM(store.jumlah_store) AS jumlah'
            ])
                ->xjoin('store')
                ->where('YEAR(store.created_at)', date("Y"))
                ->where('MONTH(store.created_at)', $i)
                ->where('distribusi.status_pekerjaan', 'proses')
                ->get();

            $data['selesai' . $i]    = $this->home->select([
                'SUM(store.jumlah_store) AS jumlah'
            ])
                ->xjoin('store')
                ->where('YEAR(store.created_at)', date("Y"))
                ->where('MONTH(store.created_at)', $i)
                ->where('distribusi.status_pekerjaan', 'selesai')
                ->get();


            $data['dikerjakan' . $i]   = $this->home->select(
                [
                    'SUM(distribusi.jumlah_set) AS jumlah'
                ]
            )
                ->where('YEAR(distribusi.created_at)', date("Y"))
                ->where('MONTH(distribusi.created_at)', $i)
                ->where('distribusi.status_pekerjaan', 'dikerjakan')
                ->get();
        }


        echo json_encode($data);
    }

    public function requestCountDoneProgress()
    {
        $this->home->table = 'progress';
        $id_progres = $this->home->select([
            'progress.id'
        ])->where('MONTH(progress.tanggal)', date("m"))->get();

        $i = 0;
        $y = 0;
        $z = 0;
        foreach($id_progres as $row) {
            if(checkDistribusi($row->id) == checkStatusSelesaiDistribusi($row->id) && checkDistribusi($row->id) != 0){
                $i++;
            }

            if(checkDistribusi($row->id) != checkStatusSelesaiDistribusi($row->id) && checkDistribusi($row->id) != 0){
                $y++;
            }

            if(checkDistribusi($row->id) == checkStatusDikerjakanDistribusi($row->id) && checkDistribusi($row->id) != 0){
                $z++;
            }


            
        }
        
        $data = [
            'selesai' => $i,
            'belum_selesai' => $y,
            'dikerjakan'    => $z
        ];

        echo json_encode($data);
        
        //print_r($data['progress']);
    }

    public function tes()
    {
        $this->home->table = 'store AS s';
        $data['countStore'] = $this->home->select([
            's.jumlah_store', 'progress.tanggal'
        ])
            ->join('distribusi')
            ->joinAlt2('progress', 'distribusi')
            ->get();


        print_r($data['countStore']);
    }
}

/* End of file Home.php */
