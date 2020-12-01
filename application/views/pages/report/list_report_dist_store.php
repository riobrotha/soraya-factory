<?php

    $convFrom = explode("/", $fromDate);
    $convTo   = explode("/", $toDate);

    $FromDate = $convFrom[2] . "-" . $convFrom[0] . "-" . $convFrom[1];
    $ToDate = $convTo[2] . "-" . $convTo[0] . "-" . $convTo[1];
?>
<div class="text-center">
    <h3>Laporan Distribusi & Store Pekerjaan Mitra</h3>
    <h5>Dari <?= date_format(new DateTime($FromDate . "00:00:00"), "d M Y"); ?> s/d <?= date_format(new DateTime($ToDate . "00:00:00"), "d M Y"); ?></h5>
</div>
<div class="table-responsive" style="margin-top: 30px;">
    <table class="table table-bordered table-striped table-hover myDatTab">
        <thead>
            <tr>
                <th>Mitra ID</th>
                <th>Nama Mitra</th>
                <th>Jumlah Set</th>
                <th>Jumlah Store</th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->jumlah_set; ?></td>
                    <td><?= $row->jumlah_store; ?></td>


                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>