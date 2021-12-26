<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\StokModel;

class Stok extends BaseController
{
    public function __construct()
    {
        $this->stokModel = new StokModel();
        $this->barangModel = new BarangModel();
    }
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/login");
        }
        echo view('stok');
    }

    public function tambah()
    {
        $data = [
            "idBarang" => $this->request->getPost("id"),
            "nama" => $this->request->getPost("nama"),
            "netto" => $this->request->getPost("netto"),
            "jmlPenyesuaian" => $this->request->getPost("jumlah"),
            "keterangan" => $this->request->getPost("keterangan"),
            "user" => session()->get("nama")
        ];

        $this->stokModel->save($data);

        $barang = $this->barangModel->where("id", $data["idBarang"])->first();

        $stok = [
            "stok" => $barang["stok"] + $data["jmlPenyesuaian"]
        ];

        $this->barangModel->update($data["idBarang"], $stok);

        echo json_encode("");
    }

    public function tampil()
    {
        $bulan = $this->request->getPost("bulan");
        $tahun = $this->request->getPost("tahun");

        $mulai = strtotime($tahun . "/" . $bulan . "/" . "1 00:00:00");
        $sampai = strtotime($tahun . "/" . $bulan . "/" . "31 23:59:59");

        echo json_encode($this->stokModel->where(['tanggal >=' => date("Y/m/d  H:i:s", $mulai), 'tanggal <=' => date("Y/m/d  H:i:s", $sampai)])->findAll());
    }

    public function tampilBarang()
    {
        echo json_encode($this->barangModel->findAll());
    }
}
