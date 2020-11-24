<!-- <?php
        if (isset($month)) {
            $bul = convertMonth($month);
        }

        ?> -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kartu Order Bal <?= $id_progress; ?> </title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        #tfoot {
            border: none !important;
        }

        h4 {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <img src="<?= base_url(); ?>assets/img/logo_soraya2.png" style="position: absolute; width: 120px; height: auto; margin-left: 20px;">
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.6; font-weight: bold;">
                    PT. SORAYA BERJAYA INDONESIA
                    <br>PABRIK SORAYA BEDSHEET <br>
                    <span style="font-weight: 400">Jalan Palangkaraya No.7, Nanggalo, Kota Padang </span>
                </span>
            </td>
        </tr>
    </table>

    <hr class="line-title">
    <div class="float-right">
        <h1 style="font-size: 60px; font-family: Arial, Helvetica, sans-serif;"><span style="font-size: 13px; font-family: Arial, Helvetica, sans-serif;"">No DO: </span>&nbsp;<?= $id_progress; ?></h1>
    </div>
    <div class=" text-center" style="margin-top: 90px;">

                <table style="width: 100%;">
                    <tr>
                        <td align="center">
                            <span style="line-height: 1.6; font-weight: 300; font-size: 26px;">
                               KARTU ORDER KAIN BAL
                               
                               
                            </span> 
                            <!-- <span>rio pambudhi</span> -->
                        </td>
                    </tr>
                </table>

                <table style="width: 100%; margin-bottom: 5px; margin-top: 30px;">
                    <tr>
                        <td>Hari / Tgl : <?= date_format(new DateTime($tanggal_progress->tanggal), "D, d M Y"); ?></td>
                        <td>Motif Kain : <?= $tanggal_progress->motif; ?></td>
                        <td>Ukuran : 231</td>
                        <td>Ditambahkan oleh : <?= $nama_admin->nama_admin == '' ? '-' : $nama_admin->nama_admin ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Ukuran : 3,2</td>
                        <td></td>
                    </tr>
                </table>

    </div>
    <div class="row">
        <div class="col-md-12 d-flex">
            <table class="table table-bordered" style="width: 50%;">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
                        <th colspan="5" class="text-center">
                            Jenis Bantal
                        </th>

                    </tr>
                    <tr>
                        <th>LOVE</th>
                        <th>BT</th>
                        <th>BIS</th>
                        <th>RC</th>
                        <th>DSC</th>
                    </tr>

                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($perencanaan as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->nama_pekerjaan; ?></td>
                            <td><?= $row->id_jenis_bantal == 1 ? $row->qty : " " ?></td>
                            <td><?= $row->id_jenis_bantal == 2 ? $row->qty : " " ?></td>
                            <td><?= $row->id_jenis_bantal == 3 ? $row->qty : " " ?></td>
                            <td><?= $row->id_jenis_bantal == 4 ? $row->qty : " " ?></td>
                            <td><?= $row->id_jenis_bantal == 5 ? $row->qty : " " ?></td>



                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>
                            <h4><b>Total :</b></h4>
                        </td>
                        <td><?php echo array_sum(array_column($total_love, 'qty')) != 0 ? array_sum(array_column($total_love, 'qty')) : '-'  ?></td>
                        <td><?php echo array_sum(array_column($total_bt, 'qty')) != 0 ? array_sum(array_column($total_bt, 'qty')) : '-'  ?></td>
                        <td><?php echo array_sum(array_column($total_bis, 'qty')) != 0 ? array_sum(array_column($total_bis, 'qty')) : '-'  ?></td>
                        <td><?php echo array_sum(array_column($total_rc, 'qty')) != 0 ? array_sum(array_column($total_rc, 'qty')) : '-'  ?></td>
                        <td><?php echo array_sum(array_column($total_dsc, 'qty')) != 0 ? array_sum(array_column($total_dsc, 'qty')) : '-'  ?></td>

                    </tr>
                </tfoot>

            </table>
            <table class="table table-bordered" style="width: 50%;">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
                        <th colspan="5" class="text-center">
                            REALISASI
                        </th>

                    </tr>
                    <tr>
                        <th>LOVE</th>
                        <th>BT</th>
                        <th>BIS</th>
                        <th>RC</th>
                        <th>DSC</th>
                    </tr>

                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($perencanaan as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->nama_pekerjaan; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>



                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>
                            <h4><b>Total :</b></h4>
                        </td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>

                    </tr>
                </tfoot>

            </table>
        </div>

    </div>







</body>


</html>