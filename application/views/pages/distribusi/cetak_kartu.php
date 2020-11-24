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
    <title>Laporan</title>
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
    <img src="assets/img/logo_soraya2.png" style="position: absolute; width: 120px; height: auto; margin-left: 20px;">
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
    <p class=" text-center" style="margin-top: 90px;">

                <span style="font-size: 24px;">KARTU ORDER KAIN BAL</span> <br>
                <!-- <?php if (isset($month)) : ?>
            <b>Bulan <?= $bul; ?></b>
        <?php endif ?>
        <?php if (isset($dateFrom) && isset($dateTo)) : ?>
            <b>Dari <?= date_format(new DateTime($dateFrom), "j M Y"); ?> Sampai <?= date_format(new DateTime($dateTo), "j M Y"); ?></b>
        <?php endif ?>
        <?php if (isset($year)) : ?>
            <b>Tahun <?= $year; ?></b>
        <?php endif ?> -->
                <table style="width: 100%; margin-bottom: 5px;">
                    <tr>
                        <td>Hari / Tgl : <?= date_format(new DateTime($tanggal_progress->tanggal), "D, d M Y"); ?></td>
                        <td>Motif Kain : <?= $tanggal_progress->motif; ?></td>

                    </tr>
                </table>

                </p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
                            <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
                            <th colspan="5" class="text-center">
                                Jenis Bantal
                            </th>

                        </tr>
                        <tr>
                            <!-- <th></th>
                <th></th> -->
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
                                <td><?= $row->id_jenis_bantal == 1 ? $row->qty : "-" ?></td>
                                <td><?= $row->id_jenis_bantal == 2 ? $row->qty : "-" ?></td>
                                <td><?= $row->id_jenis_bantal == 3 ? $row->qty : "-" ?></td>
                                <td><?= $row->id_jenis_bantal == 4 ? $row->qty : "-" ?></td>
                                <td><?= $row->id_jenis_bantal == 5 ? $row->qty : "-" ?></td>



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
                <table class="table table-bordered" style="margin-top: 50px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Pekerjaan</th>
                            <th>ID Mitra</th>
                            <th>Nama Mitra</th>
                            <th>Jumlah Set</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $no = 1;
                        foreach ($distribusi as $row) : ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $row->nama_mitrawork; ?></td>
                                <td><?= $row->id_mitra; ?></td>
                                <td><?= $row->nama; ?></td>
                                <td><?= $row->jumlah_set; ?></td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

</body>


</html>