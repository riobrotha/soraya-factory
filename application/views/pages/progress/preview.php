<section class="content">
    <div class="container-fluid">
        <!-- <div class="block-header">
            <h2>
                JQUERY DATATABLES
                <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>
            </h2>
        </div> -->
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            <?= $title_detail; ?>
                        </h2>
                        <span style="font-size: 12px; color: #b1b1b1; margin-top: 10px;">detail dari progress <?= $id; ?></span>


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
                    <div class="body" data-id="<?= $this->session->flashdata('id_insert'); ?>">

                        <?php $this->load->view('layouts/_alert'); ?>
                        <h1 style="text-align: right;"><span style="font-size: 11px;">No DO :&nbsp;&nbsp;</span><?= $id; ?></h1>
                        <div class="row bg-custom">
                            <div style="margin-top: 20px;"></div>
                            <div class="col-xs-3">
                                <p>Hari / Tgl : <?= date_format(new DateTime($data_progress->tanggal), "D / d M Y"); ?></p>
                            </div>
                            <div class="col-xs-3">
                                <p>Motif Kain : <?= $data_progress->motif; ?></p>
                            </div>
                            <div class="col-xs-3">
                                <p>Jumlah : 231</p>
                                <p>Ukuran : 3,2</p>
                            </div>
                            <div class="col-xs-3">
                                <p>Ditambahkan oleh : <?= $nama_admin->nama_admin; ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6" style="margin-top: 30px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
                                                <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
                                                <th colspan="5" class="text-center">
                                                    Jenis Bantal
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>LOVE</th>
                                                <th>BT</th>
                                                <th>BIS</th>
                                                <th>RC</th>
                                                <th>DSC</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($content as $row) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $row->nama_pekerjaan; ?></td>
                                                    <td><?= $row->id_jenis_bantal == 1 ? $row->qty : "-" ?></td>
                                                    <td><?= $row->id_jenis_bantal == 2 ? $row->qty : "-" ?></td>
                                                    <td><?= $row->id_jenis_bantal == 3 ? $row->qty : "-" ?></td>
                                                    <td><?= $row->id_jenis_bantal == 4 ? $row->qty : "-" ?></td>
                                                    <td><?= $row->id_jenis_bantal == 5 ? $row->qty : "-" ?></td>



                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <h4><b>Total :</b></h4>
                                                </td>
                                                <td><?php echo array_sum(array_column($total_love, 'qty')) != 0 ? array_sum(array_column($total_love, 'qty')) : '-'  ?></td>
                                                <td><?php echo array_sum(array_column($total_bt, 'qty')) != 0 ? array_sum(array_column($total_bt, 'qty')) : '-'  ?></td>
                                                <td><?php echo array_sum(array_column($total_bis, 'qty')) != 0 ? array_sum(array_column($total_bis, 'qty')) : '-'  ?></td>
                                                <td><?php echo array_sum(array_column($total_rc, 'qty')) != 0 ? array_sum(array_column($total_rc, 'qty')) : '-'  ?></td>
                                                <td><?php echo array_sum(array_column($total_dsc, 'qty')) != 0 ? array_sum(array_column($total_dsc, 'qty')) : '-'  ?></td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-6" style="margin-top: 30px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
                                                <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
                                                <th colspan="5" class="text-center">
                                                    REALISASI
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>LOVE</th>
                                                <th>BT</th>
                                                <th>BIS</th>
                                                <th>RC</th>
                                                <th>DSC</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($content as $row) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $row->nama_pekerjaan; ?></td>
                                                    <td><?= $row->id_jenis_bantal == 1 ? $row->jumlah_realisasi : "-" ?></td>
                                                    <td><?= $row->id_jenis_bantal == 2 ? $row->jumlah_realisasi : "-" ?></td>
                                                    <td><?= $row->id_jenis_bantal == 3 ? $row->jumlah_realisasi : "-" ?></td>
                                                    <td><?= $row->id_jenis_bantal == 4 ? $row->jumlah_realisasi : "-" ?></td>
                                                    <td><?= $row->id_jenis_bantal == 5 ? $row->jumlah_realisasi : "-" ?></td>



                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <h4><b>Total :</b></h4>
                                                </td>
                                                <td><?php echo array_sum(array_column($total_love_realisasi, 'jumlah_realisasi')) != 0 ? array_sum(array_column($total_love_realisasi, 'jumlah_realisasi')) : '-'  ?></td>
                                                <td><?php echo array_sum(array_column($total_bt_realisasi, 'jumlah_realisasi')) != 0 ? array_sum(array_column($total_bt_realisasi, 'jumlah_realisasi')) : '-'  ?></td>
                                                <td><?php echo array_sum(array_column($total_bis_realisasi, 'jumlah_realisasi')) != 0 ? array_sum(array_column($total_bis_realisasi, 'jumlah_realisasi')) : '-'  ?></td>
                                                <td><?php echo array_sum(array_column($total_rc_realisasi, 'jumlah_realisasi')) != 0 ? array_sum(array_column($total_rc_realisasi, 'jumlah_realisasi')) : '-'  ?></td>
                                                <td><?php echo array_sum(array_column($total_dsc_realisasi, 'jumlah_realisasi')) != 0 ? array_sum(array_column($total_dsc_realisasi, 'jumlah_realisasi')) : '-'  ?></td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php //$this->load->view('pages/progress/table_realisasi'); 
                        ?>

                    </div>
                </div>
            </div>
        </div>



    </div>
</section>