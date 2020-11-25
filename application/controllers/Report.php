<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{

    public function index()
    {
    }

    public function showSelect()
    {
        $this->report->table = 'mitra';
        $mitra = $this->report->get();
        $option = '';
        foreach ($mitra as $row) {


            $option .= '<option value="' . $row->id . '">' . $row->nama . ' - ' . $row->id . '  </option>';
        }

        $output = '<select class="form-control show-tick select2" name="id_mitra" id="id_mitra">
                            <option></option>
                            ' . $option . '
                            </select>';

        echo $output;
    }

    public function mitra()
    {
        $this->report->table = 'mitra';
        $data['mitra'] = $this->report->get();
        $data['title']          = 'Laporan Mitra';
        $data['nav_title']      = 'laporan-mitra';
        $data['title_detail']   = 'Form Laporan Mitra';
        $data['page']           = 'pages/report/mitra';

        $this->view($data);
        //print_r($data['mitra']);
    }

    public function requestDataMitra()
    {
        $id_mitra = $this->input->post('id_mitra', true);

        if($id_mitra){
            $this->report->table = 'mitra';
            $data['getMitra'] = $this->report->where('id', $id_mitra)->first();

        }

        if($data['getMitra']){
            $this->load->view('pages/report/list_data_mitra', $data);
        }
    }

    public function requestMitraReport()
    {
        //if ($this->input->is_ajax_request()) {
        $id_mitra = $this->input->post('id_mitra', true);
        $fromDate = $this->input->post('fromDate', true);
        $toDate   = $this->input->post('toDate', true);

        $fromDate2 = strtotime($fromDate);
        $toDate2   = strtotime($toDate);

        if ($id_mitra && $fromDate && $toDate) {
            $this->report->table = 'distribusi';
            $data['content'] = $this->report->select([
                'progress.id', 'store.created_at AS tanggal_store', 'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'store.jumlah_store', 'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->xjoin('store')
                ->where('store.created_at >=', date("Y-m-d", $fromDate2))
                ->where('store.created_at <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->get();

            $data['countSelesai'] = $this->report->select([
                'progress.id', 'store.created_at AS tanggal_store', 'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'store.jumlah_store', 'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->xjoin('store')
                ->where('store.created_at >=', date("Y-m-d", $fromDate2))
                ->where('store.created_at <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->where('distribusi.status_pekerjaan', 'selesai')
                ->count();

            $data['countProses'] = $this->report->select([
                'progress.id', 'store.created_at AS tanggal_store', 'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'store.jumlah_store', 'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->xjoin('store')
                ->where('store.created_at >=', date("Y-m-d", $fromDate2))
                ->where('store.created_at <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->where('distribusi.status_pekerjaan', 'proses')
                ->count();
        }
        $this->load->view('pages/report/list_report_mitra', $data);


        //}
    }

    public function requestMitraChart()
    {
        
        $id_mitra = $this->input->post('id_mitra', true);
        

        if ($id_mitra) {
            $this->report->table = 'distribusi';

            for ($i = 1; $i <= 12; $i++) {
                $data['selesai' . $i] = $this->report->select(
                    [
                        'distribusi.status_pekerjaan', 'COUNT(distribusi.status_pekerjaan) AS jumlah', 'MONTH(store.created_at) AS bulan'
                    ]
                )
                    ->xjoin('store')
                    ->where('distribusi.id_mitra', $id_mitra)
                    ->where('YEAR(store.created_at)', date("Y"))
                    ->where('MONTH(store.created_at)', $i)
                    ->where('distribusi.status_pekerjaan', 'selesai')
                    
                    ->get();

                $data['proses' . $i] = $this->report->select(
                    [
                        'distribusi.status_pekerjaan', 'COUNT(distribusi.status_pekerjaan) AS jumlah', 'MONTH(store.created_at) AS bulan'
                    ]
                )
                    ->xjoin('store')
                    ->where('distribusi.id_mitra', $id_mitra)
                    ->where('YEAR(store.created_at)', date("Y"))
                    ->where('MONTH(store.created_at)', $i)
                    ->where('distribusi.status_pekerjaan', 'proses')
                    
                    ->get();
            }

            echo json_encode($data);

           
        }


        //}
    }
}

/* End of file Report.php */
