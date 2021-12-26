<?php $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Barang</h1>

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
                        <th>NETTO</th>
                        <th>STOK</th>
                        <th>HARGA</th>
                        <th>KULAK</th>
                        <th>HAPUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $j = 1;
                    for ($i = count($barang) - 1; $i > -1; $i--) :
                    ?>
                        <tr id="baris<?= $barang[$i]['id'] ?>">
                            <td><?= $j ?></td>
                            <td><?= $barang[$i]['id'] ?></td>
                            <td><?= $barang[$i]['nama'] ?></td>
                            <td><?= $barang[$i]['netto'] ?></td>
                            <td><?= $barang[$i]['stok'] ?></td>
                            <td><?= $barang[$i]['harga'] ?></td>
                            <td><?= $barang[$i]['hargaKulak'] ?></td>
                            <td><a href="#" class="badge badge-danger p-2" id="hapus<?= $barang[$i]['id'] ?>" onClick="tryHapus(<?= $barang[$i]['id'] ?>, '<?= $barang[$i]['nama'] ?>', '<?= $barang[$i]['netto'] ?>')"><i class="fas fa-trash"></i></a></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Netto</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="netto" name="netto" placeholder="Netto. (contoh 20 ml)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" value="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Harga Kulak</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="hargaKulak" name="hargaKulak" placeholder="Harga Kulak" value="0">
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
                <h5 class="modal-title">Hapus Barang</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="idHapus" name="idHapus">
                <p>Apakah anda yakin ingin menghapus <b id="detailHapus">....</b> ?</p>
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
        } else if ($("#netto").val() == "") {
            $("#netto").focus();
        } else if (document.getElementById("harga").value == "") {
            $("#harga").val(0);
        } else if (document.getElementById("hargaKulak").value == "") {
            $("#hargaKulak").val(0);
        } else {
            $.ajax({
                type: 'POST',
                data: 'nama=' + $("#nama").val() + '&netto=' + $("#netto").val() + '&harga=' + $("#harga").val() + '&hargaKulak=' + $("#hargaKulak").val(),
                url: '<?= base_url() ?>/barang/tambah',
                dataType: 'json',
                success: function(data) {
                    $("#nama").val("");
                    $("#netto").val("");
                    $("#harga").val(0);

                    $('#modalTambah').modal('hide');
                    $("<tr id='baris" + data["id"] + "'><td>0</td><td>" + data["id"] + "</td><td>" + data["nama"] + "</td><td>" + data["netto"] + "</td><td>" + data["stok"] + "</td><td>" + data["harga"] + "</td><td>" + data["hargaKulak"] + '</td><td><a href="#" class="badge badge-danger p-2" id="hapus' + data['id'] + '" onClick=\'tryHapus(' + data['id'] + ', "' + data['nama'] + '", " ' + data['netto'] + '")\'><i class="fas fa-trash"></i></a></td></tr>').prependTo("#dataTable");
                    //ambil_data();
                }
            });
        }
    }

    function tryHapus(id, nama, netto) {
        $("#hapus" + id).html('<i class="fas fa-spinner fa-pulse"></i>')
        $("#idHapus").val(id)
        $("#detailHapus").html(nama + " (" + netto + ") ")
        $("#hapus" + id).html('<i class="fas fa-trash"></i>')
        $("#modalHapus").modal('show')
    }

    function hapus() {
        $("#hapus").html('<i class="fas fa-spinner fa-pulse"></i> Memproses..')
        var id = $("#idHapus").val()
        $.ajax({
            url: '<?= base_url() ?>/barang/hapus',
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