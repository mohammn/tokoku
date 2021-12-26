<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\BarangModel;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->barangModel = new BarangModel();
    }
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/login");
        }
        echo view('transaksi');
    }


    public function tambah()
    {
        //tinggal pengurangan stok di tabel barang
        //buat satu hari hanya ada 1 transaksi untuk 1 barang. (ditambah jumlah saja jik ada yg double)
        $barang = $this->request->getPost("transaksi");
        for ($i = 0; $i < count($barang); $i++) {
            $stok = $this->barangModel->where('id', $barang[$i]["idBarang"])->first();
            $this->barangModel->update($barang[$i]["idBarang"], ["stok" => $stok["stok"] - $barang[$i]["jumlah"]]);
            $barang[$i]["user"] = session()->get("nama");
            $this->transaksiModel->save($barang[$i]);
        }
        echo json_encode("");
    }

    public function transaksiTerakhir()
    {
        $tanggalMulai = $this->request->getPost('tanggalMulai') . " 00:00:00";
        $tanggalSelesai = $this->request->getPost('tanggalSelesai') . " 23:59:59";

        $barang = $this->transaksiModel->where(['tanggal >=' => $tanggalMulai, 'tanggal <=' => $tanggalSelesai])->findAll();
        $barangBaru = [];
        for ($i = count($barang) - 1; $i > -1; $i--) {
            if (count($barangBaru) < 5) {
                array_push($barangBaru, $barang[$i]);
            } else {
                break;
            }
        }
        echo json_encode($barangBaru);
    }
}
