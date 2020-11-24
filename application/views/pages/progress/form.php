<section class="content">
    <div class="container-fluid">

        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $id; ?></h1>
                        <h2>
                            TAMBAH DATA PROGRESS BARU
                            <small>Isi form di bawah ini, untuk menambahkan progress baru.</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?= form_open_multipart($form_action, ['method' => 'POST']); ?>
                        <!-- <?= isset($input->id) ? form_hidden('id', $input->id) : form_hidden('id', 'MTR-' . rand(pow(10, 3 - 1), pow(10, 3) - 1) . date('YmdHis')); ?> -->
                        <h2 class="card-inside-title">Data Progress</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-top: 30px;">
                                    <div class="form-line">
                                        <?=
                                            form_input('id', $id, [
                                                'class' => 'form-control',
                                                'id' => 'id_progress',
                                                'disabled' => true
                                            ]);

                                        ?>
                                        <label class="form-label">No OD</label>

                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?= $input->id; ?>" id="noOd">
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                            form_input('motif', $input->motif, [
                                                'class' => 'form-control',
                                                'id' => 'motif',
                                            ]);

                                        ?>
                                        <label class="form-label">Nama Motif Kain</label>
                                        <?= form_error('motif'); ?>
                                    </div>
                                </div>


                            </div>

                            <!-- <div class="col-sm-6">
                                <div class="form-group form-float" style="margin-top: 10px;">
                                    <div class="form-line">
                                        <?=
                                            form_input('ukuran', $input->ukuran, [
                                                'class' => 'form-control',
                                                'id' => 'ukuran',
                                            ]);

                                        ?>
                                        <label class="form-label">Ukuran Kain</label>
                                        <?= form_error('ukuran'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group form-float" style="margin-top: 10px;">
                                    <div class="form-line">
                                        <?=
                                            form_input('jumlah', $input->jumlah, [
                                                'class' => 'form-control',
                                                'id' => 'jumlah',
                                            ]);

                                        ?>
                                        <label class="form-label">Jumlah Kain</label>
                                        <?= form_error('jumlah'); ?>
                                    </div>
                                </div>
                            </div> -->

                            <div class="col-sm-12">

                                <button class="btn btn-primary btn-lg waves-effect" style="float: right;" type="submit">SUBMIT</button>

                            </div>
                        </div>






                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input -->


    </div>
</section>