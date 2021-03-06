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
        <?php
        $pemasukanBulanIni = $data['totalPemasukanBulanIni']['totalAnggaran'];
        $pengeluaranBulanIni = $data['totalPengeluaranBulanIni']['totalAnggaran'];
        $totalSaldobulanIni = intval($pemasukanBulanIni) - intval($pengeluaranBulanIni);

        $totalPemasukanSampaiBulanLalu = $data['totalPemasukanSampaiBulanLalu']['totalAnggaran'];
        $totalPengeluaranSampaiBulanLalu = $data['totalPengeluaranSampaiBulanLalu']['totalAnggaran'];
        $totalSaldoBulanLaulu = intval($totalPemasukanSampaiBulanLalu) - intval($totalPengeluaranSampaiBulanLalu);

        $totalPemasukanKeseluruhan = intval($pemasukanBulanIni) + intval($totalPemasukanSampaiBulanLalu);
        $totalPengeluranKeseluruhan = intval($pengeluaranBulanIni) + intval($totalPengeluaranSampaiBulanLalu);
        $totalSaldoKeseluruhan = intval($totalPemasukanKeseluruhan) - intval($totalPengeluranKeseluruhan);

        ?>
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

                                    <h5 class="mt-0">Rp <?= number_format($pemasukanBulanIni); ?></h5>
                                    <p class="mb-0 text-muted">Total Pemasukan bulan Ini <span class="badge bg-soft-success"></p>
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

                                    <h5 class="mt-0">Rp <?= number_format($pengeluaranBulanIni); ?></h5>
                                    <p class="mb-0 text-muted">Pengeluara bulan ini <span class="badge bg-soft-success"></p>
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
                                    <h5 class="mt-0">Rp <?= number_format($totalSaldoKeseluruhan) ?></h5>
                                    <p class="mb-0 text-muted">Total Anggaran <span class="badge bg-soft-success"></p>
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
                                    <h5 class="mt-0"><?= $data['totalKegiatan']['total_count'] ?></h5>
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
                        <h4 class="mt-0 header-title">Data Pemasukan bulan ini</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Kredit</th>
                                    <th>Debit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $anggaranArr = $data['anggaran'];
                                $no = 0;
                                foreach ($anggaranArr as $anggaran) :
                                    $no++;
                                    if($no > 6) break;
                                    $debit = ($anggaran['debit'] != '-') ? $anggaran['debit'] : 0;
                                    $kredit = ($anggaran['kredit'] != '-') ? $anggaran['kredit'] : 0;
                                    $totalSaldo = $debit - $kredit;
                                ?>

                                    <tr>
                                        <td><?= $anggaran['tanggal']; ?></td>
                                        <td><?= $anggaran['nama_kegiatan_result']; ?></td>
                                        <td><?= number_format($debit); ?></td>
                                        <td><?= number_format($kredit); ?></td>
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

                        <h4 class="mt-0 header-title">Anggaran</h4>

                        <div id="chartData" class="h-300"></div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>
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
                    label: 'Pemasukan',
                    value: <?= $totalPemasukanKeseluruhan; ?>,
                    color: '#00b359'
                },
                {
                    label: 'Pengeluaran',
                    value: <?= $totalPengeluranKeseluruhan ?>,
                    color: '#ff0303'
                }
            ]
        });
    </script>