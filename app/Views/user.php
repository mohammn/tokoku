<?php $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data User</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalTambah">Tambah</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ID</th>
                        <th>NAMA</th>
                        <th>JABATAN</th>
                        <th>HAPUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $j = 1;
                    for ($i = count($user) - 1; $i > -1; $i--) :
                    ?>
                        <tr id="baris<?= $user[$i]['id'] ?>">
                            <td><?= $j ?></td>
                            <td><?= $user[$i]['id'] ?></td>
                            <td><?= $user[$i]['nama'] ?></td>
                            <td><?php if ($user[$i]['rule'] == 1) {
                                    echo "Admin";
                                } else {
                                    echo "Karyawan";
                                } ?></td>
                            <td><a href="#" class="badge badge-danger p-2" id="hapus<?= $user[$i]['id'] ?>" onClick="tryHapus(<?= $user[$i]['id'] ?>, '<?= $user[$i]['nama'] ?>')"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    <?php $j++;
                    endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select name="jabatan" id="jabatan" class="form-control">
                                <option value="0">Karyawan</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="tambah()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modalHapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus User</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="idHapus" name="idHapus">
                <p>Apakah anda yakin ingin menghapus User dengan nama <b id="detailHapus">....</b> secara permanen ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="hapus()" class="btn btn-danger">Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<script>
    function tambah() {
        if ($("#nama").val() == "") {
            $("#nama").focus();
        } else if ($("#password").val() == "") {
            $("#password").focus();
        } else {
            $.ajax({
                type: 'POST',
                data: 'nama=' + $("#nama").val() + '&password=' + $("#password").val() + '&jabatan=' + $("#jabatan").val(),
                url: '<?= base_url() ?>/user/tambah',
                dataType: 'json',
                success: function(data) {
                    $("#nama").val("");
                    $("#password").val("");
                    $("#jabatan").val(0);

                    $('#modalTambah').modal('hide');
                    var baris = "<tr id='baris" + data["id"] + "'><td>0</td><td>" + data["id"] + "</td><td>" + data["nama"] + "</td><td>"
                    if (data["rule"] == 1) {
                        baris += "Admin"
                    } else {
                        baris += "Karyawan"
                    }
                    baris += "</td>" + '<td><a href="#" class="badge badge-danger p-2" id="hapus' + data['id'] + '" onClick=\'tryHapus(' + data['id'] + ', "' + data['nama'] + '", " ' + data['netto'] + '")\'><i class="fas fa-trash"></i></a></td></tr>'
                    $(baris).prependTo("#dataTable");
                    //ambil_data();
                }
            });
        }
    }

    function tryHapus(id, nama) {
        $("#hapus" + id).html('<i class="fas fa-spinner fa-pulse"></i>')
        $("#idHapus").val(id)
        $("#detailHapus").html(nama)
        $("#hapus" + id).html('<i class="fas fa-trash"></i>')
        $("#modalHapus").modal('show')
    }

    function hapus() {
        $("#hapus").html('<i class="fas fa-spinner fa-pulse"></i> Memproses..')
        var id = $("#idHapus").val()
        $.ajax({
            url: '<?= base_url() ?>/user/hapus',
            method: 'post',
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                $("#idHapus").val("")
                $("#detailHapus").html("")
                $("#baris" + id).remove()
                $("#modalHapus").modal('hide')
                $("#hapus").html('Hapus')
            }
        });
    }
</script>
<?php $this->endSection() ?>