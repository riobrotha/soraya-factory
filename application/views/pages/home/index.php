<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">web_asset</i>
                    </div>
                    <div class="content">
                        <div class="text" style="text-transform: uppercase;">Proses&nbsp;<strong>(<?= date("M"); ?>)</strong></div>
                        <div class="number count-to" data-from="0" data-to="<?= $countProgress; ?>" data-speed="500" data-fresh-interval="10"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">local_shipping</i>
                    </div>
                    <div class="content" style="text-transform: uppercase;">
                        <div class="text">Total Distribusi</div>
                        <div style="display: flex;">
                            <div class="number count-to" data-from="0" data-to="<?= array_sum(array_column($countDist, 'jumlah_set')); ?>" data-speed="500" data-fresh-interval="10"></div>
                            <span style="margin-left: 5px; margin-top: 5px;">Set</span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">done_all</i>
                    </div>
                    <div class="content" style="text-transform: uppercase;">
                        <div class="text">Total Store</div>
                        <div style="display: flex;">
                            <div class="number count-to" data-from="0" data-to="<?= array_sum(array_column($countStore, 'jumlah_store')); ?>" data-speed="500" data-fresh-interval="10"></div>
                            <span style="margin-left: 5px; margin-top: 5px;">Set</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content" style="text-transform: uppercase;">
                        <div class="text">Mitra</div>
                        <div class="number count-to" data-from="0" data-to="<?= $countMitra; ?>" data-speed="500" data-fresh-interval="10"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

        <!-- <div class="row clearfix">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            Progress Store Pekerjaan Mitra
                        </h2>



                    </div>
                    <div class="body" id="dashboard_chart_place">







                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            Grafik Progress
                        </h2>



                    </div>
                    <div class="body" id="progress_chart_place">






                    </div>
                </div>
            </div>
        </div> -->
        <div class="row clearfix">
            <!-- Line Chart -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>PROGRESS STORE & DISTRIBUSI MITRA (<?= date("Y"); ?>)</h2>
                       
                    </div>
                    <div class="body" id="dashboard_chart_place">

                    </div>
                </div>
            </div>
            <!-- #END# Line Chart -->
            <!-- Bar Chart -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">GRAFIK PROGRESS (<?= date("M"); ?>) </h2>
                        
                    </div>
                    <div class="body" id="progress_chart_place">

                    </div>
                </div>
            </div>
            <!-- #END# Bar Chart -->
        </div>

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>TOP FIVE MITRA</h2>
                        
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mitra ID</th>
                                        <th>Nama Mitra</th>
                                        <th>Jumlah Set</th>
                                        <th>Jumlah Store</th>
                                        <th>Sisa</th>
                                        <th>Persentase</th>
                                        <th>Progress Bar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($rankMitra as $row) : ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $row->id; ?></td>
                                            <td><?= $row->nama; ?></td>
                                            <td><?= $row->jumlah_set; ?></td>
                                            <td><?= $row->jumlah_store; ?></td>
                                            <td>
                                                <?= $row->belum_selesai; ?>
                                                <!-- <div class="progress">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                </div> -->
                                            </td>
                                            <?php $percent = getPersentase($row->jumlah_store, $row->jumlah_set); ?>
                                            <td>
                                                <?php
                                                if ($percent >= 0 && $percent < 70) {
                                                    $warna = "col-red";
                                                } else if ($percent >= 71 && $percent < 94) {
                                                    $warna = "col-orange";
                                                } else {
                                                    $warna = "col-green";
                                                }

                                                ?>
                                                <span class="<?= $warna; ?>"><strong><?= round($percent); ?>%</strong></span>
                                            </td>

                                            <?php
                                            switch ($no) {
                                                case 1:
                                                    $warna_progress = "bg-green";
                                                    break;
                                                case 2:
                                                    $warna_progress = "bg-blue";
                                                    break;
                                                case 3:
                                                    $warna_progress = "bg-orange";
                                                    break;
                                                case 4:
                                                    $warna_progress = "bg-pink";
                                                    break;
                                                case 5:
                                                    $warna_progress = "bg-indigo";
                                                    break;
                                            }

                                            $no++;

                                            ?>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar <?= $warna_progress; ?>" role="progressbar" aria-valuenow="<?= round($percent); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= round($percent); ?>%"></div>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php endforeach ?>
                                    <!-- <tr>
                                        <td>2</td>
                                        <td>Task B</td>
                                        <td><span class="label bg-blue">To Do</span></td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                            </div>
                                        </td>
                                    </tr> -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->

        </div>
    </div>
</section>