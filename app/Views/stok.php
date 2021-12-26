<?php $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Penyesuaian Stok Barang</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row m-2 p-2">
            <div class="col-2">Menampilkan data </div>
            <div class="col-1">
                Bulan :
            </div>
            <div class="col-3">
                <select class="form-control form-control-sm" id="bulan" onchange="ambilData()">
                    <option value="1" <?php if (date('m') == 1) echo "selected"; ?>>Januari</option>
                    <option value="2" <?php if (date('m') == 2) echo "selected"; ?>>Februari</option>
                    <option value="3" <?php if (date('m') == 3) echo "selected"; ?>>Maret</option>
                    <option value="4" <?php if (date('m') == 4) echo "selected"; ?>>April</option>
                    <option value="5" <?php if (date('m') == 5) echo "selected"; ?>>Mei</option>
                    <option value="6" <?php if (date('m') == 6) echo "selected"; ?>>Juni</option>
                    <option value="7" <?php if (date('m') == 7) echo "selected"; ?>>Juli</option>
                    <option value="8" <?php if (date('m') == 8) echo "selected"; ?>>Agustus</option>
                    <option value="9" <?php if (date('m') == 9) echo "selected"; ?>>September</option>
                    <option value="10" <?php if (date('m') == 10) echo "selected"; ?>>Oktober</option>
                    <option value="11" <?php if (date('m') == 11) echo "selected"; ?>>November</option>
                    <option value="12" <?php if (date('m') == 12) echo "selected"; ?>>Desember</option>
                </select>
            </div>
            <div class="col-1">
                Tahun :
            </div>
            <div class="col-3">
                <select class="form-control form-control-sm" id="tahun" onchange="ambilData()">
                    <?php for ($i = 2020; $i < date("Y") + 1; $i++) { ?>
                        <option value="<?php echo $i;  ?>" <?php if (date('Y') == $i) echo "selected"; ?>><?php echo $i;  ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah</button>
            </div>
        </div>
    </div>
    <div class="card-body">


        <div class="table-responsive" id="tempatTabel">
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penyesuaian Stok Barang</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="id" class="col-sm-2 col-form-label">Id Barang</label>
                        <div class="col-sm-10">
                            <input oninput="tampilData()" onchange="tampilData()" type="text" class="form-control" id="id" autocomplete="TRUE" list="daftarBarang" placeholder="">
                            <datalist onchange="tampilData()" id="daftarBarang">

                            </datalist>
                            <div id="errorBarang"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Netto</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="netto" name="netto" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Jumlah Penyesuaian</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Penyesuaian. contoh : 3 atau -3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Contoh : kulakan, salah input, rusak, dll">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="tambah" onclick="tambah()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    ambilData()
    muatBarang()
    var barangKosong = true;
    var barang = [];

    function ambilData() {
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();
        $("#tempatTabel").html('<i class="fas fa-spinner fa-pulse"></i> Memuat...')
        var tabel = '<table id="tabelStok" class="display table table-striped table-hover" ><thead><tr><th>TANGGAL</th><th>ID BARANG</th><th>NAMA</th><th>NETTO</th><th>PENYESUAIAN</th><th>KETERANGAN</th><th>USER</th></tr></thead><tbody>'
        var baris = ''
        $.ajax({
            url: '<?= base_url() ?>/stok/tampil',
            method: 'post',
            data: "tahun=" + tahun + "&bulan=" + bulan,
            dataType: 'json',
            success: function(data) {
                for (let i = 0; i < data.length; i++) {
                    baris = '<tr><td>' + data[i].tanggal + '</td><td>' + data[i].idBarang + '</td> <td>' + data[i].nama + '</td><td>' + data[i].netto + '</td><td>' + data[i].jmlPenyesuaian + '</td><td>' + data[i].keterangan + '</td><td>' + data[i].user + '</td></tr>' + baris
                }
                tabel += baris + '</tbody></table>'
                $("#tempatTabel").html(tabel)
                $('#tabelStok').DataTable({
                    "order": [
                        [0, 'desc']
                    ],
                    "pageLength": 10,
                });
            }
        });
    }

    function muatBarang() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>/stok/tampilBarang',
            dataType: 'json',
            success: function(data) {
                barang = data;
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].id + '">' + data[i].nama + ' (' + data[i].netto + ')</option>';;
                }
                $("#daftarBarang").html(html);
            }
        });
    }

    function tampilData() {
        // alert(document.getElementById('kode').value);
        $("#errorBarang").html("")
        barangKosong = true;
        for (var i = 0; i < barang.length; i++) {
            if ($('#id').val() == barang[i].id) {
                $('#nama').val(barang[i].nama);
                $('#netto').val(barang[i].netto);

                barangKosong = false;
            }
        }

        if (barangKosong) {
            $("#errorBarang").html("<small class='text-danger'>id tidak ditemukan.</small>")
            $('#nama').val("");
            $('#netto').val("");
        }
    }

    function tambah() {
        $("#tambah").html('<i class="fas fa-spinner fa-pulse"></i>')
        $("#tambah").prop('disabled', true)
        if (barangKosong) {
            $("#id").focus();
        } else if ($("#jumlah").val() == "" || $("#jumlah").val() == 0) {
            $("#jumlah").focus();
        } else if ($("#keterangan").val() == "") {
            $("#keterangan").focus();
        } else {
            $.ajax({
                type: 'POST',
                data: 'id=' + $("#id").val() + '&nama=' + $("#nama").val() + '&netto=' + $("#netto").val() + '&jumlah=' + $("#jumlah").val() + '&keterangan=' + $("#keterangan").val(),
                url: '<?= base_url() ?>/stok/tambah',
                dataType: 'json',
                success: function(data) {
                    $("#id").val("");
                    $("#nama").val("");
                    $("#netto").val("");
                    $("#jumlah").val("");
                    $("#keterangan").val("");

                    $("#tambah").html('Simpan')
                    $("#tambah").prop('disabled', false)

                    $('#modalTambah').modal('hide');
                    ambilData()
                }
            });
        }
    }
</script>
<?php $this->endSection() ?>