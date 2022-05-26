<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>"><?= APL_NAME; ?></a></li>
                            <li class="breadcrumb-item active"><?= $data['judul']; ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= ucwords($data['judul']); ?></h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row container-fluid">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <!-- <i class="mdi mdi-credit-card"></i> -->
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                            </div>
                            <div class="col-9 align-self-center text-right">
                                <div class="m-l-10">
                                    <?php
                                    $dataLunas = $data['lunas']['total_sum'];
                                    ?>
                                    <h5 class="mt-0">Rp <?= number_format($data['lunas']['total_sum']) ?></h5>
                                    <p class="mb-0 text-muted">Pajak yang Telah dibayarkan <span class="badge bg-soft-success"></p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height:3px;">
                            <div class="progress-bar  bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-weight"></i>
                                </div>
                            </div>
                            <div class="col-9 align-self-center text-right">
                                <div class="m-l-10">
                                    <?php $dataTunggakan = $data['tunggakan']['total_sum']; ?>
                                    <h5 class="mt-0">Rp <?= number_format($data['tunggakan']['total_sum']) ?></h5>
                                    <p class="mb-0 text-muted">Tunggakan <span class="badge bg-soft-success"></p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height:3px;">
                            <div class="progress-bar  bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-cash"></i>
                                </div>
                            </div>
                            <div class="col-9 align-self-center text-right">
                                <div class="m-l-10">
                                    <h5 class="mt-0">Rp <?= number_format(intval($data['totalAnggran']['total_sum']) - ($data['lunas']['total_sum'])); ?></h5>
                                    <p class="mb-0 text-muted">Anggran setelah dikenai pajak <span class="badge bg-soft-success"></p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height:3px;">
                            <div class="progress-bar  bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-tag-multiple"></i>
                                </div>
                            </div>
                            <div class="col-9 align-self-center text-right">
                                <div class="m-l-10">
                                    <h5 class="mt-0"><?= number_format(intval($data['totalKegitan']['total_count'])); ?></h5>
                                    <p class="mb-0 text-muted">Kegiatan<span class="badge bg-soft-success"></p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height:3px;">
                            <div class="progress-bar  bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row container-fluid">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Tunggakan</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Pajak</th>
                                    <th>Rincian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['tunggakanPajakData'] as $data_loop_result) : ?>
                                    <tr>
                                        <td><?= $data_loop_result['tanggal']; ?></td>
                                        <td><?= $data_loop_result['nama_kegiatan']; ?></td>
                                        <td><?= $data_loop_result['pajak']; ?></td>
                                        <td><?= $data_loop_result['keterangan']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Pajak</h4>

                        <div id="chartData" class="h-300"></div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--Morris Chart-->
    <script src="<?= BASEURL ?>/assets/plugins/morris/morris.min.js"></script>
    <script src="<?= BASEURL ?>/assets/plugins/raphael/raphael-min.js"></script>
    <script src="<?= BASEURL ?>/assets/pages/morris.init.js"></script>

    <script>
        $('#datatable2').DataTable();

        $(document).ready(function() {
            console.log(loopResult(totalPajakKeseluruahan));
        });

        new Morris.Donut({
            element: 'chartData',
            data: [{
                    label: 'Lunas',
                    value: <?= $dataLunas; ?>,
                    color: '#00b359'
                },
                {
                    label: 'Tunggakan',
                    value: <?= $dataTunggakan ?>,
                    color : '#ff0303'
                }
            ]
        });
    </script>