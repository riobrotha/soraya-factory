<section class="content">
    <div class="container-fluid">

        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $content->id; ?></h1>
                        <h2>
                            TAMBAH DATA PERENCANAAN BARU
                            <small>Isi form di bawah ini, untuk menambahkan perencanaan baru.</small>
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
                        <button class="btn btn-warning waves-effect" id="tambahForm">Tambah Form</button>
                        <?= form_open_multipart('progress/insert_plan', ['method' => 'POST']); ?>
                        <?= isset($content->id) ? '<input type="hidden" name="id" value="'.$content->id.'" id="idProgress">' : ''; ?>

                        <!-- <h2 class="card-inside-title">Data Perencanaan</h2> -->
                        <div class="row clearfix">

                            <!-- <div class="col-sm-4" style="margin-top: 20px;">
                                <h4 class="card-inside-title" style="font-size: 14px;">Pilih Jenis Pekerjaan</h4>
                                <?= form_dropdown('id_jenis_pekerjaan', getDropdownList('jenis_pekerjaan', ['id', 'nama_pekerjaan']), '', ['class' => 'form-control show-tick']); ?>

                            </div>
                            <div class="col-sm-4" style="margin-top: 20px;">
                                <h2 class="card-inside-title">Pilih Jenis Bantal</h2>
                                <?= form_dropdown('id_jenis_bantal', getDropdownList('jenis_bantal', ['id', 'nama_jenis_bantal']), '', ['class' => 'form-control show-tick']); ?>
                            </div>

                            <div class="col-sm-4" style="margin-top: 20px;">
                                <div class="form-group form-float">
                                    <h2 class="card-inside-title">Kuantitas</h2>
                                    <div class="form-line tgl_lahir">
                                        <?=
                                            form_input('qty', '', [
                                                'class' => 'form-control valTglLahir',
                                                'id' => 'qty',
                                            ]);

                                        ?>
                                        <?= form_error('tgl_lahir'); ?>

                                    </div>
                                </div>
                            </div> -->

                            <div class="form-baru">

                            </div>



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