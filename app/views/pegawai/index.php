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
    <?php Flasher::flash(); ?>
    <div id="message"></div>

    <div class="row container-fluid text-center">
        <div class="col-lg-5 text-center">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Input Data Pegawai</h4>
                    <!-- SELECT `id`, `nama_pegawai`, `alamat`, `nip`, `agama` FROM `pegawai` WHERE 1 -->
                    <form action="<?= BASEURL; ?>/pegawai/tambah" method="post" class="form-enter" id="formInputData">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="hidden" value="" id="id_pegawai" name="id_pegawai" placeholder="">
                                <input class="form-control" type="text" value="" id="nama_pegawai" name="nama_pegawai" placeholder="nama pegawai">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="" id="nip" name="nip" placeholder="nomor pegawai">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="jabatan" id="jabatan">
                                    <option value="">Select Jabatan</option>
                                    <option value="<?= KEPALA ?>">PPTK</option>
                                    <option value="<?= BENDAHARA ?>">Bendahara</option>
                                    <option value="<?= PENGGUNA ?>">Pengguna Anggaran</option>
                                    <option value="<?= STAF ?>">Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-5">
                                <a href="#" class="btn btn-primary waves-effect waves-light" onclick="saveData()"> Save </a>
                                <button class="btn btn-danger waves-effect waves-light" type="reset" onclick="reload_location('pegawai')"> Reset </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row container-fluid">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <!-- <pre>
                        <?php print_r($data['pegawai']);?>
                    </pre> -->
                    <table id="datatable2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No Pegawai</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['pegawai'] as $data) : ?>
                                <tr>
                                    <td><?= $data['nip']; ?></td>
                                    <td><?= $data['nama_pegawai']; ?></td>
                                    <td><?= $data['jabatan']; ?></td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/pegawai/hapus/<?= $data['id_pegawai']; ?>/<?= $data['jabatan'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Yakin?');">
                                            <span>
                                                Hapus
                                            </span>
                                        </a>
                                        <a href="#" class="getUbah btn btn-primary waves-effect waves-light" data-id="<?= $data['id_pegawai']; ?>">
                                            <span>
                                                Ubah
                                            </span>
                                        </a>
                                       
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<script>
    $(document).ready(function() {
        $('.form-enter').on('keypress', function(e) {
            return e.which !== 13;
        });

        $('#datatable2').DataTable();

        $('.getUbah').on('click', function() {

            const id = $(this).data('id')
            $.ajax({
                url: '<?= BASEURL; ?>/pegawai/getUbah/',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data.id_pegawai);
                    $("#id_pegawai").val(data.id_pegawai);
                    $("#nama_pegawai").val(data.nama_pegawai);
                    $("#nip").val(data.nip);
                    $("#jabatan").val(data.jabatan);

                    $(".card-body form").attr('action', '<?= BASEURL; ?>/pegawai/ubah')
                    $('.card-body form button[type=submit]').html('Ubah Data')

                }
            });
        });
    });

    function saveData() {
        if ($('#nama_pegawai').val() == "") {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, data yang di isi harus lengkap', 'danger', 'Pegawai'));
            return
        }
        if ($('#nip').val() == "") {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, data yang di isi harus lengkap', 'danger', 'Pegawai'));
            return
        }
        if ($('#bidang').val() == "") {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, data yang di isi harus lengkap', 'danger', 'Pegawai'));
            return
        }
        if ($('#jabatan').val() == "") {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, data yang di isi harus lengkap', 'danger', 'Pegawai'));
            return
        }

        $('#formInputData').submit();
    }

    function message(pesan, aksi, tipe, data) {
        allert_load = "";
        allert_load += '<div class="alert alert-' + tipe + ' alert-dismissible fade show" role="alert">'
        allert_load += 'Data ' + data + ' <strong>' + pesan + ' </strong> ' + aksi
        allert_load += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
        allert_load += '<span aria-hidden="true">&times;</span>'
        allert_load += '</button>'
        allert_load += '</div>'
        return allert_load
    }
</script>