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
    </div>

    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered data-table-format">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No Rekening</th>
                            <th>Uraian</th>
                            <th>Debit</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dataPemasukan = $data['anggaran'];
                        $no = 0;
                        foreach ($dataPemasukan as $pemasukan) :
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $pemasukan['tanggal']; ?></td>
                                <td><?= $pemasukan['no_rekening']; ?></td>
                                <td><?= $pemasukan['keterangan']; ?></td>
                                <td><?= $pemasukan['debit']; ?></td>
                                <td><?= $pemasukan['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('.data-table-format').DataTable();
    });
</script>