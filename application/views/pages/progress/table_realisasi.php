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
                    <tr class="<?= checkRealisasi($row->id) > 0 ? "bg-orange" : "" ?>">
                        <td><?= $row->id; ?></td>
                        <td><?= $row->motif; ?></td>
                        <td><?= date_format(new DateTime($row->tanggal), "d/m/Y"); ?></td>
                        <!-- <td><?= date_format(new DateTime($row->tanggal), "H:i"); ?>&nbsp;WIB</td> -->
                        <td>
                            <div class="text-center">
                                <a href="<?= base_url("progress/add_realisasi/$row->id"); ?>" class="btn bg-deep-purple waves-effect">Tambah Realisasi</a>
                                <?php if (checkRealisasi($row->id) > 0) : ?>
                                    <a href="<?= base_url("progress/preview/$row->id"); ?>" class="btn bg-deep-orange waves-effect">View</a>
                                <?php endif ?>
                            </div>
                        </td>
                    </tr>
                <?php endif ?>
            <?php endforeach ?>
        </tbody>
    </table>
</div>