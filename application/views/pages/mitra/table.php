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
                        
                        if($diff->m == 0){
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
                        if($row->status_nikah == "belum_nikah"){
                            echo 'Belum Nikah';
                        } else {
                            echo 'Nikah';
                        }
                    
                    ?></td>
                   
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>