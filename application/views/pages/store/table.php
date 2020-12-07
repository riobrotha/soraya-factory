<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
                <?php if (checkDistribusi($row->id) > 0) : ?>
                    <tr class="<?= checkDistribusi($row->id) == checkStatusSelesaiDistribusi($row->id) && checkDistribusi($row->id) != 0 ? "bg-blue-grey" : "" ?>">
                        <td><?= $row->id; ?></td>
                        <td><?= $row->motif; ?></td>
                        <td><?= date_format(new DateTime($row->tanggal), "d/m/Y"); ?></td>
                        <!-- <td><?= date_format(new DateTime($row->tanggal), "H:i"); ?>&nbsp;WIB</td> -->
                        <td>
                            <div class="text-center">

                                <?php if (checkDistribusi($row->id) > 0) : ?>
                                    <a href="#" class="btn btn-success waves-effect view_store" data-id="<?= $row->id; ?>">View</a>
                                <?php endif ?>

                            </div>
                        </td>
                    </tr>
                <?php endif ?>
            <?php endforeach ?>
        </tbody>
    </table>
</div>