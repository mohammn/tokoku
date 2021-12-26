<?php $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<div class="row mt--2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div class="col-sm-2">
                        <h2 class="card-title">Laporan</h2>
                        <div id="pesanError" class="badge badge-danger"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="pillInput" class="badge badge-warning">Dari tgl</label>
                            <input type="date" class="form-control input-pill" id="tanggalMulai" onChange="tampilkan()" placeholder="Rp">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="pillInput" class="badge badge-warning">Sampai tgl</label>
                            <input type="date" class="form-control input-pill" onChange="tampilkan()" id="tanggalSelesai" placeholder="Rp">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="numbers">
                            <p class="badge badge-success">Keuntungan :</p>
                            <h5 class="card-title" id="keuntungan">Rp. 0</h5>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="numbers">
                            <p class="badge badge-success">Pemasukan :</p>
                            <h5 class="card-title" id="pemasukan">Rp. 0</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="tabelLaporan">

            </div>
        </div>
    </div>
</div>

<script>
    settanggal()
    tampilkan()

    function settanggal() {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);

        $("#tanggalMulai").val(today)
        $("#tanggalSelesai").val(today)
    }

    function tampilkan() {
        // tampilkanChart()
        var tanggalMulai = $("#tanggalMulai").val()
        var tanggalSelesai = $("#tanggalSelesai").val()

        if (tanggalMulai > tanggalSelesai) {
            $("#pesanError").html("Tanggal Mulai tidak Boleh Melebihi tanggal Selesai")
        } else {
            $("#pesanError").html("")
            $("#tombolProses").html('<i class="fas fa-spinner fa-pulse"></i> Memproses...')

            var keuntungan = 0;
            var totalKeuntungan = 0;
            var pemasukan = 0;
            var totalPemasukan = 0;
            var tabel = '<table id="add-row" class="display table table-striped table-hover" ><thead><tr><th>NO</th><th>ID</th><th>TANGGAL</th><th>NAMA</th><th>NETTO</th><th>KULAK</th><th>HARGA</th><th>JUMLAH</th><th>TOTAL</th><th>UNTUNG</th><th>KASIR</th></tr></thead><tbody>'
            $.ajax({
                url: '<?= base_url() ?>/laporan/dataPenjualan',
                method: 'post',
                data: "tanggalMulai=" + tanggalMulai + "&tanggalSelesai=" + tanggalSelesai,
                dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    for (let i = 0; i < data.length; i++) {
                        pemasukan = (data[i].harga * data[i].jumlah)
                        totalPemasukan += pemasukan
                        keuntungan = ((data[i].harga - data[i].hargaKulak) * data[i].jumlah)
                        totalKeuntungan += keuntungan
                        tabel += '<tr>'
                        tabel += '<td>' + (i + 1) + '</td>'
                        tabel += '<td>' + data[i].idBarang + '</td>'
                        tabel += '<td>' + data[i].tanggal + '</td>'
                        tabel += '<td>' + data[i].nama + '</td>'
                        tabel += '<td>' + data[i].netto + '</td>'
                        tabel += '<td>' + formatRupiah(data[i].hargaKulak) + '</td>'
                        tabel += '<td>' + formatRupiah(data[i].harga) + '</td>'
                        tabel += '<td>' + data[i].jumlah + '</td>'
                        tabel += '<td>' + formatRupiah((data[i].harga * data[i].jumlah).toString()) + '</td>'
                        tabel += '<td>' + formatRupiah(keuntungan.toString()) + '</td>'
                        tabel += '<td>' + data[i].user + '</td>'
                        tabel += '</tr>'
                    }
                    tabel += '</tbody></table>'
                    $("#tabelLaporan").html(tabel)
                    $("#keuntungan").html('Rp. ' + formatRupiah(totalKeuntungan.toString()))
                    $("#pemasukan").html('Rp. ' + formatRupiah(totalPemasukan.toString()))

                    $('#add-row').DataTable({
                        "pageLength": 10,
                    });
                    $("#tombolProses").html('Proses')
                }
            });

        }
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<?php $this->endSection() ?>