<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr>
                <th style="width: 20px;"></th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Is Active</th>
                <th class="text-center">Action</th>


            </tr>
        </thead>
        <tbody>

            <?php
            $i = 0;
            foreach ($content as $row) : ?>
                <tr>
                    <td>
                        <input type="checkbox" id="md_checkbox<?= $i ?>" class="filled-in chk-col-cyan check-item" name="id[]" value="<?= $row->id; ?>" />
                        <label for="md_checkbox<?= $i ?>"></label>
                    </td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->username; ?></td>
                    <td><?= $row->role; ?></td>
                    <td><?= $row->is_active == 1 ? 'Active' : 'Not Active'; ?></td>
                    <td>
                        <div class="text-center">
                           
                            <a href="<?= base_url("user/edit/$row->id"); ?>" class="btn btn-info waves-effect">Edit</a>
                            <a href="<?= base_url("user/delete/$row->id"); ?>" class="btn btn-danger waves-effect" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>

                        </div>
                    </td>

                </tr>
            <?php
                $i++;
            endforeach ?>
        </tbody>
    </table>
</div>