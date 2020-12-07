<!-- Jquery Core Js -->
<script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/node-waves/waves.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-countto/jquery.countTo.js"></script>
<!-- charjs -->
<script src="<?= base_url('assets'); ?>/plugins/chartjs/Chart.bundle.js"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<!-- Autosize Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/autosize/autosize.js"></script>

<!-- Moment Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/momentjs/moment.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Bootstrap Datepicker Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Dropzone Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/dropzone/dropzone.js"></script>

<!-- Custom Js -->
<script src="<?= base_url('assets'); ?>/js/admin.js"></script>
<!-- <script src="<?= base_url('assets'); ?>/js/pages/charts/chartjs.js"></script> -->

<script src="<?= base_url('assets'); ?>/js/pages/forms/basic-form-elements.js"></script>
<script src="<?= base_url('assets'); ?>/js/pages/tables/jquery-datatable.js"></script>

<!-- Demo Js -->

<script src="<?= base_url('assets'); ?>/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<script>
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        url: "<?php echo base_url("user/uploadImage/") ?>",
        acceptedFiles: "image/*",
        maxFilesize: 2, // MB
        method: "post",
        maxFiles: 1,
        init: function() {
            this.on("success", function(file, response) {
                var obj = jQuery.parseJSON(response);
                $('#image_admin').val(obj.file_name);
            })
        }

    });
</script>

<script>

</script>
<?php  ?>
<script>
    $(document).ready(function() {
        $('.myTable').DataTable({
            "order": [
                [2, "desc"]
            ], //or asc 
            "columnDefs": [{
                "targets": 2,
                "type": "date-eu"
            }],
        });

        $('.myDatTab').DataTable();
        
        function getChartJs(type, nilai) {
            var config = null;

            if (type === 'line') {
                config = {
                    type: 'line',
                    data: {
                        labels: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "Mei",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Okt",
                            "Nov",
                            "Dec"
                        ],
                        datasets: [{
                            label: "Selesai",
                            data: [
                                nilai.selesai1[0].jumlah,
                                nilai.selesai2[0].jumlah,
                                nilai.selesai3[0].jumlah,
                                nilai.selesai4[0].jumlah,
                                nilai.selesai5[0].jumlah,
                                nilai.selesai6[0].jumlah,
                                nilai.selesai7[0].jumlah,
                                nilai.selesai8[0].jumlah,
                                nilai.selesai9[0].jumlah,
                                nilai.selesai10[0].jumlah,
                                nilai.selesai11[0].jumlah,
                                nilai.selesai12[0].jumlah
                            ],
                            borderColor: 'rgba(0, 188, 212, 0.75)',
                            backgroundColor: 'rgba(0, 188, 212, 0.3)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                            pointBorderWidth: 1
                        }, {
                            label: "Proses",
                            data: [
                                nilai.proses1[0].jumlah,
                                nilai.proses2[0].jumlah,
                                nilai.proses3[0].jumlah,
                                nilai.proses4[0].jumlah,
                                nilai.proses5[0].jumlah,
                                nilai.proses6[0].jumlah,
                                nilai.proses7[0].jumlah,
                                nilai.proses8[0].jumlah,
                                nilai.proses9[0].jumlah,
                                nilai.proses10[0].jumlah,
                                nilai.proses11[0].jumlah,
                                nilai.proses12[0].jumlah
                            ],
                            borderColor: 'rgba(233, 30, 99, 0.75)',
                            backgroundColor: 'rgba(233, 30, 99, 0.3)',
                            pointBorderColor: 'rgba(233, 30, 99, 0)',
                            pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                            pointBorderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            } else if (type === 'bar') {
                config = {
                    type: 'bar',
                    data: {
                        labels: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "Mei",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Okt",
                            "Nov",
                            "Dec"
                        ],
                        datasets: [{
                            label: "Selesai",
                            data: [
                                nilai.selesai1[0].jumlah,
                                nilai.selesai2[0].jumlah,
                                nilai.selesai3[0].jumlah,
                                nilai.selesai4[0].jumlah,
                                nilai.selesai5[0].jumlah,
                                nilai.selesai6[0].jumlah,
                                nilai.selesai7[0].jumlah,
                                nilai.selesai8[0].jumlah,
                                nilai.selesai9[0].jumlah,
                                nilai.selesai10[0].jumlah,
                                nilai.selesai11[0].jumlah,
                                nilai.selesai12[0].jumlah
                            ],
                            backgroundColor: 'rgba(0, 188, 212, 0.8)'
                        }, {
                            label: "Proses",
                            data: [
                                nilai.proses1[0].jumlah,
                                nilai.proses2[0].jumlah,
                                nilai.proses3[0].jumlah,
                                nilai.proses4[0].jumlah,
                                nilai.proses5[0].jumlah,
                                nilai.proses6[0].jumlah,
                                nilai.proses7[0].jumlah,
                                nilai.proses8[0].jumlah,
                                nilai.proses9[0].jumlah,
                                nilai.proses10[0].jumlah,
                                nilai.proses11[0].jumlah,
                                nilai.proses12[0].jumlah
                            ],
                            backgroundColor: 'rgba(233, 30, 99, 0.8)'
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: true
                    }
                }
            } else if (type === 'radar') {
                config = {
                    type: 'radar',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                        datasets: [{
                            label: "My First dataset",
                            data: [65, 25, 90, 81, 56, 55, 40],
                            borderColor: 'rgba(0, 188, 212, 0.8)',
                            backgroundColor: 'rgba(0, 188, 212, 0.5)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                            pointBorderWidth: 1
                        }, {
                            label: "My Second dataset",
                            data: [72, 48, 40, 19, 96, 27, 100],
                            borderColor: 'rgba(233, 30, 99, 0.8)',
                            backgroundColor: 'rgba(233, 30, 99, 0.5)',
                            pointBorderColor: 'rgba(233, 30, 99, 0)',
                            pointBackgroundColor: 'rgba(233, 30, 99, 0.8)',
                            pointBorderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            } else if (type === 'pie') {
                config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [225, 50, 100, 40],
                            backgroundColor: [
                                "rgb(233, 30, 99)",
                                "rgb(255, 193, 7)",
                                "rgb(0, 188, 212)",
                                "rgb(139, 195, 74)"
                            ],
                        }],
                        labels: [
                            "Pink",
                            "Amber",
                            "Cyan",
                            "Light Green"
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            }
            return config;
        }

        $('#loadIcon').hide();


        let id_progress = $('#id_progress').val();
        let id_progress2 = $('#idProgress').val();
        $('#noOd').val(id_progress);
        $('.form-baru').append("<input type='hidden' name='id_progress[]' value='" + id_progress2 + "'" + ">" +
            "<div class='col-xs-4' style='margin-top: 20px;'>" +
            "<h2 class='card-inside-title'>Jenis Pekerjaan</h2>" +
            "<select class='form-control show-tick' name='id_jenis_pekerjaan[]'>" +
            "<option>- Select -</option>" +
            "<option value='1'>BC MURMER</option>" +
            "<option value='2'>BCB</option>" +
            "<option value='3'>180 MURMER</option>" +
            "<option value='4'>180 KARET</option>" +
            "<option value='5'>160 KARET</option>" +
            "<option value='6'>180 KARET TK 40 KK</option>" +
            "<option value='7'>180 R3SS</option>" +
            "<option value='8'>160 R3SS</option>" +
            "<option value='9'>120 KARET</option>" +
            "<option value='10'>120 A/B KARET</option>" +
            "<option value='11'>120 A/B R3SS</option>" +
            "</select>" +
            "</div>" +
            "<div class='col-xs-4' style='margin-top: 20px;'>" +
            "<h2 class='card-inside-title'>Jenis Bantal</h2>" +
            "<select class='form-control show-tick' name='id_jenis_bantal[]'>" +
            "<option>- Select -</option>" +
            "<option value='1'>LOVE</option>" +
            "<option value='2'>BT</option>" +
            "<option value='3'>BIS</option>" +
            "<option value='4'>RC</option>" +
            "<option value='5'>DSC</option>" +
            "</select>" +
            "</div>" +
            "<div class='col-xs-4' style='margin-top: 20px;'>" +
            "<h2 class='card-inside-title'>Kuantitas</h2>" +
            "<div class='form-group'>" +
            "<div class='form-line'>" +
            "<input type='text' class='form-control' name='qty[]' required />" +
            "</div>" +
            "</div>" +
            "</div>"
        );

        $(document).on('click', '#tambahForm', function() {
            // for (i = 0; i <= 2; i++) {
            $('.form-baru').append("<input type='hidden' name='id_progress[]' value='" + id_progress2 + "'" + ">" +
                "<div class='col-xs-4' style='margin-top: 20px;'>" +

                "<select class='form-control show-tick' name='id_jenis_pekerjaan[]' required>" +
                "<option>- Select -</option>" +
                "<option value='1'>BC MURMER</option>" +
                "<option value='2'>BCB</option>" +
                "<option value='3'>180 MURMER</option>" +
                "<option value='4'>180 KARET</option>" +
                "<option value='5'>160 KARET</option>" +
                "<option value='6'>180 KARET TK 40 KK</option>" +
                "<option value='7'>180 R3SS</option>" +
                "<option value='8'>160 R3SS</option>" +
                "<option value='9'>120 KARET</option>" +
                "<option value='10'>120 A/B KARET</option>" +
                "<option value='11'>120 A/B R3SS</option>" +
                "</select>" +
                "</div>" +
                "<div class='col-xs-4' style='margin-top: 20px;'>" +

                "<select class='form-control show-tick' name='id_jenis_bantal[]'>" +
                "<option>- Select -</option>" +
                "<option value='1'>LOVE</option>" +
                "<option value='2'>BT</option>" +
                "<option value='3'>BIS</option>" +
                "<option value='4'>RC</option>" +
                "<option value='5'>DSC</option>" +
                "</select>" +
                "</div>" +
                "<div class='col-xs-4' style='margin-top: 20px;'>" +

                "<div class='form-group'>" +
                "<div class='form-line'>" +
                "<input type='text' class='form-control' name='qty[]' required />" +
                "</div>" +
                "</div>" +
                "</div>"
            );


        });


        loadForm();
        $('#select2222').select2();
        loadSelect2ReportMitra();


        $(document).on('click', '#tambahFormDistribusi', function() {
            loadForm();
        });

        function loadForm() {
            $.ajax({
                url: "<?php echo base_url("distribusi/showForm/") ?>" + id_progress2,
                method: "POST",

                success: function(response) {
                    //console.log(response);

                    $('.form-baru-distribusi').append(response);
                    $('.select2').select2({
                        placeholder: "- Select -",
                        allowClear: true
                    });
                }
            });
        }

        
       


        function loadSelect2ReportMitra() {
            $.ajax({
                url: "<?php echo base_url("report/showSelect") ?>",
                method: "POST",

                success: function(response) {
                    $('.form-select').html(response);
                    $('.select2').select2({
                        placeholder: "- Select -",
                        allowClear: true,

                    });
                }
            });
        }

        $(document).on('submit', '#form_report_mitra', function(e) {
            e.preventDefault();

            var fromDate = $('#from_date').val();
            var toDate = $('#to_date').val();
            var id_mitra = $('#id_mitra').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("report/requestMitraReport") ?>",
                data: {
                    id_mitra: id_mitra,
                    fromDate: fromDate,
                    toDate: toDate
                },
                beforeSend: function() {
                    $('#loadIcon').show();
                },
                success: function(response) {
                    $('.result-report-mitra').html(response);
                    $('#loadIcon').hide();
                    // new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));

                }
            });

        });

        $(document).on('submit', '#form_report_mitra', function(e) {
            var id_mitra = $('#id_mitra').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("report/requestMitraChart") ?>",
                data: {
                    id_mitra: id_mitra,

                },

                success: function(response) {
                    var data = JSON.parse(response);
                    var i;

                    console.log(data.selesai10);
                    //data.selesai11.length
                    //  if (data.bln11[0])
                    $('.chartjs-hidden-iframe').remove();
                    $('#bar_chart').remove();
                    $('#chart_place').html('<canvas id="bar_chart"></canvas>');
                    new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('line', data));
                }
            });
        });

        $(document).on('submit', '#form_report_mitra', function(e) {
            var id_mitra = $('#id_mitra').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("report/requestDataMitra") ?>",
                data: {
                    id_mitra: id_mitra,

                },
                beforeSend: function() {
                    $('#loadIcon').show();
                },
                success: function(response) {
                    $('.result-data-mitra').html(response);
                    $('#loadIcon').hide();
                }
            });
        });


        $(document).on('submit', '#form_report_dist_store', function(e) {
            e.preventDefault();
            var fromDateDistStore = $('#from_date_dist_store').val();
            var toDateDistStore = $('#to_date_dist_store').val();

            $.ajax({
                method: "POST",
                url: "<?php echo base_url('report/requestDistStore') ?>",
                data: {
                    fromDateDistStore: fromDateDistStore,
                    toDateDistStore: toDateDistStore
                },
                beforeSend: function() {
                    $('#loadIcon').show();
                },
                success: function(response) {
                    $('.result-data-dist-store').html(response);
                    $('.myDatTab').DataTable();
                    $('#loadIcon').hide();
                }
            });
        });




        $(document).on('change', '.valTglLahir', function() {
            let x = $(this).val();
            let explode = x.split("/");
            $('.tgl_lahir').addClass('focused');
            let konversiTglLahir = explode[2] + "-" + explode[0] + "-" + explode[1];

            $('#tglLahir').val(konversiTglLahir);

            // $(this).val(explode[3]+ "-" + changeMonth(explode[2]) + "-" + explode[1]);
            // //alert(changeMonth(explode[2]));

            // //0 = hari, 1 = tanggal, 2 = 
            // //alert(explode[2]);
        });

        $(document).on('change', '.valTglKerja', function() {
            let x = $(this).val();
            let explode = x.split("/");

            $('.tgl_kerja').addClass('focused');
            let konversiTglKerja = explode[2] + "-" + explode[0] + "-" + explode[1];
            $('#tglKerja').val(konversiTglKerja);
        });

        $(document).on("click", ".view", function(e) {
            e.preventDefault();

            var id = $(this).data("id");

            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('distribusi/detail/'); ?>" + id,
                    data: {
                        id: id
                    }

                })
                .done(function(data) {
                    $('.wadah-modal').html(data);
                    $('#modal-detail-distribusi').modal('show');
                });


        });

        $(document).on("click", ".view_store", function(e) {
            e.preventDefault();

            var id = $(this).data("id");

            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('store/detail/'); ?>" + id,
                    data: {
                        id: id
                    }

                })
                .done(function(data) {
                    $('.wadah-modal').html(data);
                    $('#modal-detail-store').modal('show');
                });


        });


        // $(document).on('click', '#btnMulDel', function(){
        //     var confirm = window.confirm("Apakah Yakin Ingin Menghapus Data Ini?");

        //     if(confirm){
        //         $("#form-multiple=del").submit();
        //     }
        // });




        function changeMonth(m) {
            var bln;
            switch (m) {
                case "January":
                    bln = "01";
                    break;
                case "February":
                    bln = "02";
                    break;
                case "March":
                    bln = "03";
                    break;
                case "April":
                    bln = "04";
                    break;
                case "May":
                    bln = "05";
                    break;
                case "June":
                    bln = "06";
                    break;
                case "July":
                    bln = "07";
                    break;
                case "August":
                    bln = "08";
                    break;
                case "September":
                    bln = "09";
                    break;
                case "October":
                    bln = "10";
                    break;
                case "November":
                    bln = "11";
                    break;
                case "December":
                    bln = "12";
                    break;

            }

            return bln;

        }

        loadChartDashboard();
        loadChartProgressDashboard();

        function loadChartDashboard() {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("home/requestProgressChart") ?>",


                success: function(response) {
                    var data = JSON.parse(response);

                    //$('.chartjs-hidden-iframe').remove();
                    $('#store_chart').remove();
                    $('#dashboard_chart_place').html('<canvas id="store_chart"></canvas>');
                    new Chart(document.getElementById("store_chart").getContext("2d"), getChartDashboard('line', data));
                }
            });
        }

        function loadChartProgressDashboard() {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("home/requestCountDoneProgress") ?>",


                success: function(response) {
                    var data = JSON.parse(response);

                    //$('.chartjs-hidden-iframe').remove();
                    $('#progress_chart').remove();
                    $('#progress_chart_place').html('<canvas id="progress_chart"></canvas>');
                    new Chart(document.getElementById("progress_chart").getContext("2d"), getChartDashboard('bar', data));
                }
            });
        }

        //new Chart(document.getElementById("store_chart").getContext("2d"), getChartDashboard('line', data));

        function getChartDashboard(type, nilai) {
            var config = null;

            if (type === 'line') {
                config = {
                    type: 'line',
                    data: {
                        labels: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "Mei",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Okt",
                            "Nov",
                            "Dec"
                        ],
                        datasets: [{
                                label: "Selesai",
                                data: [
                                    nilai.selesai1[0].jumlah == null ? 0 : nilai.selesai1[0].jumlah,
                                    nilai.selesai2[0].jumlah == null ? 0 : nilai.selesai2[0].jumlah,
                                    nilai.selesai3[0].jumlah == null ? 0 : nilai.selesai3[0].jumlah,
                                    nilai.selesai4[0].jumlah == null ? 0 : nilai.selesai4[0].jumlah,
                                    nilai.selesai5[0].jumlah == null ? 0 : nilai.selesai5[0].jumlah,
                                    nilai.selesai6[0].jumlah == null ? 0 : nilai.selesai6[0].jumlah,
                                    nilai.selesai7[0].jumlah == null ? 0 : nilai.selesai7[0].jumlah,
                                    nilai.selesai8[0].jumlah == null ? 0 : nilai.selesai8[0].jumlah,
                                    nilai.selesai9[0].jumlah == null ? 0 : nilai.selesai9[0].jumlah,
                                    nilai.selesai10[0].jumlah == null ? 0 : nilai.selesai10[0].jumlah,
                                    nilai.selesai11[0].jumlah == null ? 0 : nilai.selesai11[0].jumlah,
                                    nilai.selesai12[0].jumlah == null ? 0 : nilai.selesai12[0].jumlah,
                                ],
                                borderColor: 'rgba(0, 188, 212, 0.75)',
                                backgroundColor: 'rgba(0, 188, 212, 0.3)',
                                pointBorderColor: 'rgba(0, 188, 212, 0)',
                                pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                                pointBorderWidth: 1
                            }, {
                                label: "Dikerjakan",
                                data: [
                                    nilai.dikerjakan1[0].jumlah == null ? 0 : nilai.dikerjakan1[0].jumlah,
                                    nilai.dikerjakan2[0].jumlah == null ? 0 : nilai.dikerjakan2[0].jumlah,
                                    nilai.dikerjakan3[0].jumlah == null ? 0 : nilai.dikerjakan3[0].jumlah,
                                    nilai.dikerjakan4[0].jumlah == null ? 0 : nilai.dikerjakan4[0].jumlah,
                                    nilai.dikerjakan5[0].jumlah == null ? 0 : nilai.dikerjakan5[0].jumlah,
                                    nilai.dikerjakan6[0].jumlah == null ? 0 : nilai.dikerjakan6[0].jumlah,
                                    nilai.dikerjakan7[0].jumlah == null ? 0 : nilai.dikerjakan7[0].jumlah,
                                    nilai.dikerjakan8[0].jumlah == null ? 0 : nilai.dikerjakan8[0].jumlah,
                                    nilai.dikerjakan9[0].jumlah == null ? 0 : nilai.dikerjakan9[0].jumlah,
                                    nilai.dikerjakan10[0].jumlah == null ? 0 : nilai.dikerjakan10[0].jumlah,
                                    nilai.dikerjakan11[0].jumlah == null ? 0 : nilai.dikerjakan11[0].jumlah,
                                    nilai.dikerjakan12[0].jumlah == null ? 0 : nilai.dikerjakan12[0].jumlah,
                                ],
                                borderColor: 'rgba(233, 30, 99, 0.75)',
                                backgroundColor: 'rgba(233, 30, 99, 0.3)',
                                pointBorderColor: 'rgba(233, 30, 99, 0)',
                                pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                                pointBorderWidth: 1
                            },
                            {
                                label: "Proses",
                                data: [
                                    nilai.proses1[0].jumlah == null ? 0 : nilai.proses1[0].jumlah,
                                    nilai.proses2[0].jumlah == null ? 0 : nilai.proses2[0].jumlah,
                                    nilai.proses3[0].jumlah == null ? 0 : nilai.proses3[0].jumlah,
                                    nilai.proses4[0].jumlah == null ? 0 : nilai.proses4[0].jumlah,
                                    nilai.proses5[0].jumlah == null ? 0 : nilai.proses5[0].jumlah,
                                    nilai.proses6[0].jumlah == null ? 0 : nilai.proses6[0].jumlah,
                                    nilai.proses7[0].jumlah == null ? 0 : nilai.proses7[0].jumlah,
                                    nilai.proses8[0].jumlah == null ? 0 : nilai.proses8[0].jumlah,
                                    nilai.proses9[0].jumlah == null ? 0 : nilai.proses9[0].jumlah,
                                    nilai.proses10[0].jumlah == null ? 0 : nilai.proses10[0].jumlah,
                                    nilai.proses11[0].jumlah == null ? 0 : nilai.proses11[0].jumlah,
                                    nilai.proses12[0].jumlah == null ? 0 : nilai.proses12[0].jumlah,
                                ],
                                borderColor: 'rgba(241, 238, 74, 0.75)',
                                backgroundColor: 'rgba(240, 239, 167, 0.3)',
                                pointBorderColor: 'rgba(241, 238, 74, 0)',
                                pointBackgroundColor: 'rgba(241, 238, 74, 0.9)',
                                pointBorderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            } else if (type === 'bar') {
                config = {
                    type: 'bar',
                    data: {
                        labels: [
                            "Selesai",
                            "Belum Selesai",
                            "Dikerjakan"
                        ],
                        datasets: [{
                                label: "Jumlah",
                                data: [
                                    nilai.selesai,
                                    nilai.belum_selesai,
                                    nilai.dikerjakan

                                ],
                                backgroundColor: ['rgba(0, 188, 212, 0.6)', 'rgba(241, 238, 74, 0.6)', 'rgba(233, 30, 99, 0.6)'],

                            }

                        ]
                    },
                    options: {
                        responsive: true,
                        legend: true
                    },
                }
            } else if (type === 'radar') {
                config = {
                    type: 'radar',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                        datasets: [{
                            label: "My First dataset",
                            data: [65, 25, 90, 81, 56, 55, 40],
                            borderColor: 'rgba(0, 188, 212, 0.8)',
                            backgroundColor: 'rgba(0, 188, 212, 0.5)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                            pointBorderWidth: 1
                        }, {
                            label: "My Second dataset",
                            data: [72, 48, 40, 19, 96, 27, 100],
                            borderColor: 'rgba(233, 30, 99, 0.8)',
                            backgroundColor: 'rgba(233, 30, 99, 0.5)',
                            pointBorderColor: 'rgba(233, 30, 99, 0)',
                            pointBackgroundColor: 'rgba(233, 30, 99, 0.8)',
                            pointBorderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            } else if (type === 'pie') {
                config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [225, 50, 100, 40],
                            backgroundColor: [
                                "rgb(233, 30, 99)",
                                "rgb(255, 193, 7)",
                                "rgb(0, 188, 212)",
                                "rgb(139, 195, 74)"
                            ],
                        }],
                        labels: [
                            "Pink",
                            "Amber",
                            "Cyan",
                            "Light Green"
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            }
            return config;
        }


        $(document).on('click', '#btn_out', function(e) {

            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('mitra/showModalToMitraOut/'); ?>" + id,
                    data: {
                        id: id
                    }

                })
                .done(function(data) {
                    $('#wadah_modal_to_mitra_out').html(data);
                    $('#modal-to-mitra-out').modal('show');
                    $('#alasan-lainnya').hide();
                    $('.show-tick').selectpicker();
                });
        });

        $(document).on('change', '#select_alasan', function(){
            var getVal = $("#select_alasan option:selected").val();
            
            if(getVal == "Lainnya"){
                $('#alasan-lainnya').show(500);
            } else {
                $('#alasan-lainnya').hide(500);
            }
        });

       $('mitra-select').select2();

    });
</script>
<script src="<?= base_url('assets'); ?>/js/pages/index.js"></script>