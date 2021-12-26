<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Barang extends BaseController
{
    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/login");
        }
        $barang = $this->barangModel->orderBy('id', 'dsc')->findAll();
        $data = [
            'barang' => $barang
        ];
        echo view('barang', $data);
    }

    public function tambah()
    {
        $data = [
            "nama" => $this->request->getPost("nama"),
            "netto" => $this->request->getPost("netto"),
            "stok" => 0,
            "harga" => $this->request->getPost("harga"),
            "hargaKulak" => $this->request->getPost("hargaKulak")
        ];

        $this->barangModel->save($data);

        $data["id"] = $this->barangModel->getInsertID();

        echo json_encode($data);
    }

    public function hapus()
    {
        $this->barangModel->delete($this->request->getPost("id"));
        echo json_encode("");
    }
}
