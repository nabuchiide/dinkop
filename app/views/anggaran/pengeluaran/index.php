<?php
$dataKegiatan       = $data['kegiatan'];
?>
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

    <div class="row container-fluid">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title"></h4>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-3 col-form-label">Nama Kegiatan</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="text" value="" id="nama_kegiatan" placeholder="nama kegiatan" readonly>
                            <input class="form-control" type="hidden" value="" id="nama_kegiatan_hide" name="nama_kegiatan">
                            <input class="form-control" type="hidden" value="" id="id_kegiatan">
                            <input class="form-control" type="hidden" value="" id="tanggal_kegiatan">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="modal" data-target="#dataModal"> search </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row container-fluid" id="cardAnggaran" style="display: none;">
        <div class="col-lg">
            <div id="message"></div>
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-2">
                        <button class="btn btn-secondary waves-effect waves-light" id="button_tambah" onclick="tambahDataElement('0')" type="button"> Tambah Data </button>
                    </div>
                    <br>
                    <table class="table table-bordered data-table-format" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Keterngan</th>
                                <th>Nominal</th>
                                <th>Nomor Rekening</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- <tbody> -->
                        <tbody id="resultAnggaran">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalLabel">Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered data-table-format" width="100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Tanggal</th>
                            <th>Nama Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataKegiatan as $data) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $data['tanggal']; ?></td>
                                <td>
                                    <a href="#" class="getNamaKegiatan" data-kegiatan="<?= $data['nama_kegiatan']; ?>" data-id="<?= $data['id']; ?>" data-tanggal="<?= $data['tanggal']; ?>" data-status="<?= $data['status']; ?>" data-dismiss="modal">
                                        <span>
                                            <?= $data['nama_kegiatan']; ?>
                                        </span>
                                    </a>

                                </td>
                            </tr>
                        <?php
                            $no++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.getNamaKegiatan').on('click', function() {
            const kegiatan = $(this).data('kegiatan');
            const id = $(this).data('id');
            const tanggal = $(this).data('tanggal');
            const status = $(this).data('status');

            $("#nama_kegiatan").val(kegiatan);
            $("#nama_kegiatan_hide").val(kegiatan);
            $("#id_kegiatan").val(id);
            $("#tanggal_kegiatan").val(tanggal);
            $("#tanggal_table_anggaran").html(tanggal);

            reloadTabelAnggaran(id, tanggal);

            if (status != 0) {
                $("#form-anggaran").hide();
                $(".generate-status").hide();
            } else {
                $("#form-anggaran").show();
                $(".generate-status").show();
            }

            $("#cardAnggaran").show();
        })

    });

    function reloadTabelAnggaran(id, tanggal) {
        $.ajax({
            url: '<?= BASEURL; ?>/pengeluaran/getByKegitanAnggaran',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var data_load = '';
                const num = 0;
                console.log(data);
                if (data.length != 0) {

                    for (let index = 0; index < data.length; index++) {
                        num++;
                        var inner_data = "save_" + index;
                        var function_save = "saveDataElement('" + inner_data + "')";
                        const element = data[index];
                        data_load += '<tr>'
                        data_load += '    <td>' + num + '</td>'
                        data_load += '    <td class="dataInput"><input class="form-control" value="' + data.tanggal + '" type="date" name="tanggal" id="" placeholder="tanggal"></td>'
                        data_load += '    <td class="dataInput"><input class="form-control" value="' + data.keterangan + '" type="text" name="keterangan" id="" placeholder="keterangan"></td>'
                        data_load += '    <td class="dataInput"><input class="form-control" value="' + data.nominal + '" type="number" name="nominal" id="" placeholder="nominal"></td>'
                        data_load += '    <td class="dataInput"><input class="form-control" value="' + data.no_rekening + '" type="text" name="no_rekening" id="" placeholder="nomor rekening"></td>'
                        data_load += '    <td class="dataInput"><button class="save btn btn-primary waves-effect waves-light" id="' + inner_data + '" onclick="' + function_save + '">Simpan</button></td>'
                        data_load += '</tr>'
                    }
                }

                $('#resultAnggaran').html(data_load);
            },
            error: function() {
                console.log("ERROR");
            }
        });
    }

    function saveDataElement(id) {
        var data = document.getElementById(id).parentElement.parentElement;
        const dataLength = document.getElementById(id).parentElement.parentElement.firstChild;
        const dataLength1 = document.getElementById(id).parentElement.parentElement.childNodes;

        for (let i = 0; i < dataLength1.length; i++) {
            const element = dataLength1[i];
            if (element.children != undefined) {
                if (element.children.length != 0) {

                    for (let j = 0; j < element.children.length; j++) {
                        const element01 = element.children[j];
                        if (element01.tagName == "INPUT") {
                            element01_name = element01.name;
                            element01_value = element01.value;
                            console.log("element name :: => " + element01_name + "   ||| element_value :: => " + element01_value);

                            // var inp = document.createElement('input')
                            // inp.setAttribute('type', 'text');
                            // inp.setAttribute('name', element01_name)
                            // inp.setAttribute('value', element01_value)
                            // form_costume.append(inp)
                        }
                    }
                }
            }
        }
    }

    function tambahDataElement(id) {
        id = parseInt(id) + 1
        var inner_data = "tambah_" + id;
        var function_save = "saveDataElement('" + inner_data + "')";
        var data_load = '';
        data_load += '<tr>'
        data_load += '    <td bgcolor="SteelBlue"></td>'
        data_load += '    <td class="dataInput"><input class="form-control" value="' + $("#tanggal_kegiatan").val() + '" type="date" name="tanggal" id="" placeholder="tanggal"></td>'
        data_load += '    <td class="dataInput"><input class="form-control" value="" type="text" name="keterangan" id="" placeholder="keterangan"></td>'
        data_load += '    <td class="dataInput"><input class="form-control" value="" type="number" name="nominal" id="" placeholder="nominal"></td>'
        data_load += '    <td class="dataInput"><input class="form-control" value="" type="text" name="no_rekening" id="" placeholder="nomor rekening"></td>'
        data_load += '    <td class="dataInput"><button class="save btn btn-primary waves-effect waves-light" id="' + inner_data + '" onclick="' + function_save + '">Simpan</button></td>'
        data_load += '</tr>'
        $('#button_tambah').attr('onclick', "tambahDataElement('" + id + "')");
        $('#resultAnggaran').append(data_load);
    }
</script>