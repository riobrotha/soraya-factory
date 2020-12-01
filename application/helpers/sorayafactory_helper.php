<?php

function show_my_modal($content = '', $id = '', $data = '', $size = 'md')
{
  $CI = &get_instance();

  if ($content != '') {
    $view_content = $CI->load->view($content, $data, TRUE);

    return '<div class="modal fade" id="' . $id . '" role="dialog">
                  <div class="modal-dialog modal-' . $size . '" role="document">
                    <div class="modal-content">
                        ' . $view_content . '
                    </div>
                  </div>
                </div>';
  }
}



function getKodeMax()
{
  $CI     = &get_instance();
  $query = $CI->db->query("SELECT MAX(progress.id) AS NoODMax FROM progress WHERE MONTH(progress.tanggal) = MONTH(CURRENT_DATE)");
  $result = $query->row();
  return $result;
}

function checkRencana($id_progress)
{
  $CI     = &get_instance();
  $query = $CI->db->query("SELECT * FROM perencanaan WHERE id_progress = '$id_progress'");
  $result = $query->num_rows();
  return $result;
}

function checkRealisasi($id_progress)
{
  $CI       = &get_instance();
  $query    = $CI->db->query("SELECT * FROM realisasi, perencanaan, progress WHERE realisasi.id_perencanaan = perencanaan.id AND progress.id = perencanaan.id_progress AND progress.id = '$id_progress'");
  $result   = $query->num_rows();

  if ($result != 0) {
    return $result;
  } else {
    return false;
  }
}

function checkDistribusi($id_progress)
{
  $CI     = &get_instance();
  $query = $CI->db->query("SELECT * FROM distribusi WHERE id_progress = '$id_progress'");
  $result = $query->num_rows();
  return $result;
}

function checkStatusSelesaiDistribusi($id_progress)
{
  $CI     = &get_instance();
  $query = $CI->db->query("SELECT * FROM distribusi WHERE id_progress = '$id_progress' AND status_pekerjaan = 'selesai'");
  $result = $query->num_rows();
  return $result;
}

function checkStatusDikerjakanDistribusi($id_progress)
{
  $CI     = &get_instance();
  $query = $CI->db->query("SELECT * FROM distribusi WHERE id_progress = '$id_progress' AND status_pekerjaan = 'dikerjakan'");
  $result = $query->num_rows();
  return $result;
}

function getDropdownList($table, $columns)
{
  $CI    = &get_instance();
  $query = $CI->db->select($columns)->from($table)->get();

  if ($query->num_rows() >= 1) {
    $option1 = ['' => '- Select -'];
    $option2 = array_column($query->result_array(), $columns[1], $columns[0]);
    $options = $option1 + $option2;

    return $options;
  }


  return $options = ['' => '- Select -'];
}

function getMitra()
{
  $CI    = &get_instance();
  $query = $CI->db->query("SELECT * FROM mitra");
  $hasil = $query->result();

  foreach ($hasil as $row) {
    $val = array(
      'nama' => $row->nama
    );
  }

  return json_encode($hasil);
  // $output = '';
  // foreach ($hasil as $row) {
  //   $output .= '<option value="'.$row->id.'">"'.$row->nama.'"</option>';

  // }

  // return $output;


}

function konversiBln($blnsekarang)
{
  switch ($blnsekarang) {
    case "Jan":
      $convBln = "Jan";
      break;
    case "Feb":
      $convBln = "Feb";
      break;
    case "Mar":
      $convBln = "Mar";
      break;
    case "Apr":
      $convBln = "Apr";
      break;
    case "May":
      $convBln = "Mei";
      break;
    case "Jun":
      $convBln = "Jun";
      break;
    case "Jul":
      $convBln = "Jul";
      break;
    case "Aug":
      $convBln = "Agu";
      break;
    case "Sep":
      $convBln = "Sep";
      break;
    case "Oct":
      $convBln = "Okt";
      break;
    case "Nov":
      $convBln = "Nov";
      break;
    case "Dec":
      $convBln = "Des";
      break;
  }

  return $convBln;
}

function hashEncrypt($input)
{
  $hash   = password_hash($input, PASSWORD_DEFAULT);
  return $hash;
}

function hashEncryptVerify($input, $hash)
{
  if (password_verify($input, $hash)) {
    return true;
  } else {
    return false;
  }
}

function getPersentase($proses, $target)
{
  $persentase = ($proses/$target) * 100;
  return $persentase;
}
