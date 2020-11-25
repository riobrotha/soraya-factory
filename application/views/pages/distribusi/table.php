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
                <?php if (checkRencana($row->id) > 0) : ?>
                    <?php if ($row->status_pekerjaan = 'dikerjakan') : ?>
                        <tr>
                            <td><?= $row->id; ?></td>
                            <td><?= $row->motif; ?></td>
                            <td><?= date_format(new DateTime($row->tanggal), "d/m/Y"); ?></td>
                            <!-- <td><?= date_format(new DateTime($row->tanggal), "H:i"); ?>&nbsp;WIB</td> -->
                            <td>
                                <div class="text-center">
                                    <a href="<?= base_url("distribusi/add_work/$row->id"); ?>" class="btn btn-info waves-effect">Tambah Pembagian Tugas</a>
                                    <?php if (checkDistribusi($row->id) > 0) : ?>
                                        <a href="#" class="btn btn-success waves-effect view" data-id="<?= $row->id; ?>">View</a>
                                    <?php endif ?>

                                </div>
                            </td>
                        </tr>
                    <?php endif ?>
                <?php endif ?>
            <?php endforeach ?>
        </tbody>
    </table>
</div>