<?php $this->extend('layout/template') ?>

<?php $this->section('content') ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-4">
                <div class="tab-content m-3">
                    <div class="card-pricing2 card-success">
                        <div class="pricing-header">
                            <h3 class="fw-bold"> Transaksi </h3>
                        </div>
                        <hr>
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="idBarang">ID Barang</label>
                                        <div id="errorBarang"></div>
                                        <input oninput="tampilData()" onchange="tampilData()" type="text" class="form-control input-pill" id="idBarang" autocomplete="TRUE" list="daftarBarang" placeholder="">
                                        <datalist onchange="tampilData()" id="daftarBarang">

                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input oninput="jumlahkanBarang()" onchange="jumlahkanBarang()" type="number" min="1" class="form-control input-pill" id="jumlah" placeholder="0" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <a onclick="tambahBarang()" id="tambahBarang" class="btn btn-success btn-border w-100 fw-bold mb-3">Tambah</a>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Barang</label>
                                        <input type="text" class="form-control input-pill" id="nama" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="keterangan">Netto</label>
                                        <input type="text" class="form-control input-pill" id="netto" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group" id="statusStok">
                                        <label for="nama">Stok</label>
                                        <input type="text" class="form-control input-pill" id="stok" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" class="form-control input-pill" id="harga" placeholder="Rp" readonly>
                                        <input type="number" class="form-control input-pill" id="hargaKulak" placeholder="Rp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="total">Total</label>
                                        <input type="text" class="form-control input-pill" id="total" placeholder="Rp" readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            &nbsp;&nbsp;
                            <h4 class="card-title">Data Transaksi</h4>
                            &nbsp;&nbsp;
                            <div class="ml-md-auto py-2 py-md-0">
                                <button class="btn btn-primary btn-round" onclick="modalSimpan()">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="errorSimpan"></div>
                        <div class="table-responsive">
                            <table id="tabel_penjualan" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>ID</th>
                                        <th>Netto</th>
                                        <th>Jumlah </th>
                                        <th>Harga</th>
                                        <th style="width: 10%">Hapus</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th colspan="4">
                                            <form><input type="text" min="0" class="form-control input-pill" id="total_bayar" placeholder="Rp" readonly /></form>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Bayar</th>
                                        <th colspan="4">
                                            <form><input oninput="kembalian()" onchange="kembalian()" type="number" min="0" class="form-control input-pill" id="bayar" placeholder="Rp" /></form>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Kembali</th>
                                        <th colspan="4" id="kembalian"> 0</th>
                                    </tr>
                                </tfoot>
                                <tbody id="myTabel">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive center">
                        <h4 class="card-title text-center p-2">Daftar Transaksi Terakhir</h4>
                        <table id="tabelTransaksiTerakhir" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Netto</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="transaksiTerakhir">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalSimpan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Simpan Transaksi</h5>
            </div>
            <div class="modal-body text-center">
                <p>Apakah anda yakin ingin menyimpan Transaksi ini ?</p>
                <h5 class="badge badge-danger">Peringatan. Data yang sudah disimpan tidak dapat di edit/hapus.</h5>
                <h5 class="badge badge-danger">Pastikan data pembelian benar. Barang yang sudah dibeli,<br> tidak dapat dikembalikan/ditukar.</h5>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" id="simpanTransaksi" class="btn btn-primary" onclick="prosesTransaksi()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    muatBarang()
    transaksiTerakhir()
    var barangKosong = true;
    var barang = [];
    var transaksi = [];
    var indeksTerpilih = -1;
    var duplikat = false;
    ambilData()

    function ambilData() {
        var html = '';
        total = 0
        for (var i = 0; i < transaksi.length; i++) {
            var temp = parseInt(transaksi[i].jumlah) * parseInt(transaksi[i].harga);
            total += temp;

            html += '<tr>' +
                '<td>' + transaksi[i].nama + '</td>' +
                '<td>' + transaksi[i].idBarang + '</td>' +
                '<td>' + transaksi[i].netto + '</td>' +
                '<td>' + transaksi[i].jumlah + '</td>' +
                '<td>' + formatRupiah(transaksi[i].harga.toString()) + '</td>' +
                '<td>' +
                '<div class="form-button-action">' +
                '<button onclick="hapusTransaksi(' + i + ',' + transaksi[i].idBarang + ')" type="button" data-toggle="tooltip" title="" class="btn btn-link" data-original-title="Remove">' +
                '<i class="fa fa-times"></i>' +
                '</button>' +
                '</div>' +
                '</td>' +
                '</tr>';
        }
        if (!html) {
            html = '<td class="text-center" colspan="5">Data Masih kosong :)</td>'
        }
        $("#myTabel").html(html);
        $('#total_bayar').val(formatRupiah(total.toString()));
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
            if ($('#idBarang').val() == barang[i].id) {
                indeksTerpilih = i;
                $('#nama').val(barang[i].nama);
                $('#netto').val(barang[i].netto);
                $('#stok').val(barang[i].stok);
                $('#harga').val(formatRupiah(barang[i].harga));
                $('#hargaKulak').val(barang[i].hargaKulak);
                barangKosong = false;
                break;
            }
        }

        if (barangKosong) {
            $("#errorBarang").html("<small class='text-danger'>id tidak ditemukan.</small>")
            $('#nama').val("");
            $('#netto').val("");
        }
    }

    function jumlahkanBarang() {
        if ($('#jumlah').val() != "" && $('#harga').val() != "") {
            $('#total').val(parseInt($('#jumlah').val()) * parseInt($('#harga').val().replace(/\./g, '')));
            $('#total').val(formatRupiah($('#total').val().toString()));
        } else {
            $('#total').val("");
        }
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function tambahBarang() {
        $("#tambahBarang").html('<i class="fas fa-spinner fa-pulse"></i> Memproses..')
        if (barangKosong) {
            $("#errorBarang").html("<small class='text-danger'>id tidak ditemukan.</small>")
        } else if ($("#stok").val() < 1) {
            $("#errorBarang").html("<small class='text-danger'>Barang kosong.</small>")
        } else if (0 > ($("#stok").val() - $("#jumlah").val())) {
            $("#errorBarang").html("<small class='text-danger'>Stok Kurang.</small>")
        } else {
            if ($('#idBarang').val() == "") {
                $('#idBarang').focus();
            } else if ($('#jumlah').val() == "") {
                $('#jumlah').focus();
            } else {
                for (let i = 0; i < transaksi.length; i++) {
                    if (transaksi[i].idBarang == $("#idBarang").val()) {
                        transaksi[i]["jumlah"] = transaksi[i]["jumlah"] + parseInt($('#jumlah').val());
                        duplikat = true;
                        break;
                    }
                }

                if (!duplikat) {
                    var data = {
                        "idBarang": $("#idBarang").val(),
                        "nama": $('#nama').val(),
                        "netto": $('#netto').val(),
                        "harga": parseInt($('#harga').val().replace(/\./g, '')),
                        "hargaKulak": $('#hargaKulak').val(),
                        "jumlah": parseInt($('#jumlah').val())
                    };
                    transaksi[transaksi.length] = data;
                }

                duplikat = false;
                barang[indeksTerpilih]["stok"] -= $('#jumlah').val();
                $('#idBarang').val("");
                $('#nama').val("");
                $('#netto').val("");
                $('#harga').val("");
                $('#jumlah').val("");
                $('#stok').val("");
                $('#total').val("");
                $("#statusStok").removeClass("has-error")

                ambilData();
                //console.log(transaksi);
            }
        }

        $("#tambahBarang").html('Tambah')
    }

    function hapusTransaksi(indeks, idBarang) {
        for (let i = 0; i < barang.length; i++) {
            if (barang[i].id == idBarang) {
                barang[i]["stok"] += transaksi[indeks].jumlah
            }
        }
        transaksi.splice(indeks, 1);
        ambilData();
    }

    function kembalian() {
        if (transaksi.length > 0) {
            var penampung = formatRupiah((parseInt($('#bayar').val()) - total).toString());
            if (parseInt($('#bayar').val()) - total < 0) {
                $("#kembalian").html('- ' + penampung);
            } else {
                $("#kembalian").html(penampung);
            }
        }
    }

    function modalSimpan() {
        $("#errorSimpan").html("")
        if (transaksi.length < 1) {
            $("#errorSimpan").html("<small class='text-danger'>Catatan pembelian kosong.</small>")
        } else {
            $("#modalSimpan").modal("show")
        }
    }

    function prosesTransaksi() {
        $("#simpanTransaksi").html('<i class="fas fa-spinner fa-pulse"></i> Memproses..')
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>/transaksi/tambah',
            data: {
                'transaksi': transaksi
            },
            dataType: 'json',
            success: function(data) {
                transaksi = [];
                document.getElementById('total_bayar').value = "";
                document.getElementById('bayar').value = "";
                ambilData();
                transaksiTerakhir();
                muatBarang();
                $("#errorSimpan").html("")
                $("#simpanTransaksi").html('Simpan')
                $("#modalSimpan").modal("hide")
            }
        });

    }

    function transaksiTerakhir() {
        $("#tombolProses").html('<i class="fas fa-spinner fa-pulse"></i> Memproses...')
        $.ajax({
            url: '<?= base_url() ?>/transaksi/transaksiTerakhir',
            method: 'post',
            data: "target=tbl_penjualan&tanggalMulai=" + tanggalHariIni() + "&tanggalSelesai=" + tanggalHariIni(),
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr><td>" + data[i].idBarang + "</td><td>" + data[i].nama + "</td><td>" + data[i].netto + "</td><td>" + data[i].harga + "</td><td>" + data[i].jumlah + "</td><td>" + data[i].jumlah * data[i].harga + "<td></tr>"

                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="5">Data Masih kosong :)</td>'
                }
                $("#transaksiTerakhir").html(tabel)

                $("#tambah_button").html('Simpan')
            }
        });
    }

    function tanggalHariIni() {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        return today
    }
</script>
<?php $this->endSection() ?>