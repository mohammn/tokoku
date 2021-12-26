<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
    }

    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/login");
        }
        return view('laporan');
    }

    public function dataPenjualan()
    {
        $tanggalMulai = $this->request->getPost('tanggalMulai') . " 00:00:00";
        $tanggalSelesai = $this->request->getPost('tanggalSelesai') . " 23:59:59";
        $barang = $this->transaksiModel->where(['tanggal >=' => $tanggalMulai, 'tanggal <=' => $tanggalSelesai])->findAll();
        echo json_encode($barang);
    }
}
