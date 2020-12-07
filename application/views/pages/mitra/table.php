<?php if ($nav_title != 'mitra_out') : ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr>
                <th>No Mitra</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>Tgl Mulai Kerja</th>
                <th>Durasi Kerja</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Tempat</th>
                <th>Status</th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->tgl_lahir; ?></td>
                    <td><?= $row->tgl_mulai_kerja; ?></td>
                    <?php
                    $waktuAwal = new DateTime($row->tgl_mulai_kerja . " 00:00:00");
                    $waktuSekarang = new DateTime();
                    $diff = date_diff($waktuAwal, $waktuSekarang);

                    if ($diff->m == 0) {
                        $durasi = 'Kurang dari sebulan';
                    } else {
                        $durasi = $diff->m . ' bulan';
                    }
                    ?>

                    <td><?= $durasi; ?></td>
                    <td><?= $row->nohp; ?></td>
                    <td><?= $row->alamat; ?></td>
                    <td><?= ucfirst($row->jenis_kelamin); ?></td>
                    <td><?= ucfirst($row->tempat); ?></td>
                    <td><?php
                        if ($row->status_nikah == "belum_nikah") {
                            echo 'Belum Nikah';
                        } else {
                            echo 'Nikah';
                        }

                        ?></td>
                    <td>
                        <?php if ($nav_title != 'mitra_out') : ?>
                            <a href="<?= base_url("mitra/moveToMitraOut/$row->id") ?>" class="btn btn-danger" id="btn_out" data-id="<?= $row->id; ?>">Keluarkan</a>
                        <?php else : ?>
                            <a href="<?= base_url("mitra/moveToMitra/$row->id") ?>" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin memasukkan kembali mitra ini?')">Masukkan</a>
                        <?php endif ?>
                    </td>
                    <th style="text-align: right;">
                        <?php if ($nav_title == 'mitra') : ?>
                            <ul class="header-dropdown m-r--5" style="list-style: none;">

                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons md-18" style="color: #999999;">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?= base_url("mitra/edit/$row->id"); ?>" style="color: #03A9F4;"><i class="material-icons md-18">create</i>Edit</a></li>
                                        <li><a href="javascript:void(0);" style="color: #F44336;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="material-icons md-18">delete</i>Delete</a></li>


                                    </ul>
                                </li>
                            </ul>
                        <?php endif ?>
                    </th>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php else : ?>
    <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr>
                <th>No Mitra</th>
                <th>Nama</th>
                <th>Tgl Mulai Kerja</th>
                <th>Durasi Kerja</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Tgl Dikeluarkan</th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->nama; ?></td>
                    
                    <td><?= date_format(new DateTime($row->tgl_mulai_kerja . "00:00:00"), "d M Y") ?></td>
                    <?php
                    $waktuAwal = new DateTime($row->tgl_mulai_kerja . " 00:00:00");
                    $waktuSekarang = new DateTime();
                    $diff = date_diff($waktuAwal, $waktuSekarang);

                    if ($diff->m == 0) {
                        $durasi = 'Kurang dari sebulan';
                    } else {
                        $durasi = $diff->m . ' bulan';
                    }
                    ?>

                    <td><?= $durasi; ?></td>
                    <td><?= $row->nohp; ?></td>
                    <td><?= $row->alamat; ?></td>
                    <td><?= ucfirst($row->jenis_kelamin); ?></td>
                    <td><?= date_format(new DateTime($row->tgl_mitra_out), "d M Y H:i") ?></td>
                    
                    <td>
                        <?php if ($nav_title != 'mitra_out') : ?>
                            <a href="<?= base_url("mitra/moveToMitraOut/$row->id") ?>" class="btn btn-danger" id="btn_out" data-id="<?= $row->id; ?>">Keluarkan</a>
                        <?php else : ?>
                            <a href="<?= base_url("mitra/moveToMitra/$row->id") ?>" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin memasukkan kembali mitra ini?')">Masukkan</a>
                        <?php endif ?>
                    </td>
                    <th style="text-align: right;">
                        <?php if ($nav_title == 'mitra') : ?>
                            <ul class="header-dropdown m-r--5" style="list-style: none;">

                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons md-18" style="color: #999999;">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?= base_url("mitra/edit/$row->id"); ?>" style="color: #03A9F4;"><i class="material-icons md-18">create</i>Edit</a></li>
                                        <li><a href="javascript:void(0);" style="color: #F44336;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="material-icons md-18">delete</i>Delete</a></li>


                                    </ul>
                                </li>
                            </ul>
                        <?php endif ?>
                    </th>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php endif ?>

<div id="wadah_modal_to_mitra_out">

</div>
