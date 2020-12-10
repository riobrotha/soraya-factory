<section class="content">
    <div class="container-fluid">

        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        
                        <h2>
                            TAMBAH DATA JENIS PEKERJAAN MITRA
                            <small>Isi form di bawah ini, untuk menambahkan jenis pekerjaan mitra.</small>
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
                        <h2 class="card-inside-title">Data Jenis Pekerjaan Mitra</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                            form_input('nama_mitrawork', $input->nama_mitrawork, [
                                                'class' => 'form-control',
                                                'id' => 'jenisPekerjaanMitra',
                                            ]);

                                        ?>
                                        <label class="form-label">Nama Jenis Pekerjaan Mitra</label>
                                        <?= form_error('nama_mitrawork'); ?>
                                    </div>
                                </div>

                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                            form_input('ket', $input->ket, [
                                                'class' => 'form-control',
                                                'id' => 'ketJenisPekerjaanMitra',
                                            ]);

                                        ?>
                                        <label class="form-label">Keterangan</label>
                                        
                                    </div>
                                </div>
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