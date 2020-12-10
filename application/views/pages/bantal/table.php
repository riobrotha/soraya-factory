<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover myTable dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Bantal</th>
                <th>Keterangan</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>

                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->nama_jenis_bantal; ?></td>
                    <td><?= $row->ket == "" ? "-" : $row->ket; ?></td>
                    <td>
                        <div class="text-center">
                            <a href="<?= base_url("bantal/edit/$row->id"); ?>" class="btn btn-info waves-effect">Edit</a>
                            <a href="<?= base_url("bantal/delete/$row->id"); ?>" class="btn btn-danger waves-effect" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>

                        </div>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>
</div>