<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover myTable dataTable">
        <thead>
            <tr>
                <th>No DO</th>
                <th>Motif</th>
                <th>Tanggal</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->motif; ?></td>
                    <td><?= date_format(new DateTime($row->tanggal), "d/m/Y"); ?></td>
                    <!-- <td><?= date_format(new DateTime($row->tanggal), "H:i"); ?>&nbsp;WIB</td> -->
                    <td>
                        <div class="text-center">
                            <a href="<?= base_url("progress/add_plan/$row->id"); ?>" class="btn btn-info waves-effect">Tambah Perencanaan</a>
                            <?php if (checkRencana($row->id) > 0) : ?>
                                <!-- <a href="<?= base_url("progress/edit_plan/$row->id"); ?>" class="btn btn-success waves-effect">Ubah Perencanaan</a> -->
                                <a href="<?= base_url("progress/loadCetak/$row->id"); ?>" target="_blank" class="btn btn-danger waves-effect">Cetak</a>
                                <a href="<?= base_url("progress/edit_plan/$row->id"); ?>" class="btn btn-warning waves-effect">Edit Perencanaan</a>
                            <?php endif ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>