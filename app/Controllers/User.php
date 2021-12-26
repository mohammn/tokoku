<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        if (!session()->get('nama') or session()->get('rule') != 1) {
            return redirect()->to(base_url() . "/login");
        }
        $user = $this->userModel->findAll();
        $data = [
            'user' => $user
        ];
        echo view('user', $data);
    }

    public function tambah()
    {
        $data = [
            "nama" => $this->request->getPost("nama"),
            "password" => password_hash($this->request->getPost("password"), PASSWORD_DEFAULT),
            "rule" => $this->request->getPost("jabatan")
        ];

        $this->userModel->save($data);

        $data["id"] = $this->userModel->getInsertID();
        unset($data["password"]);

        echo json_encode($data);
    }

    public function hapus()
    {
        $this->userModel->delete($this->request->getPost("id"));
        echo json_encode("");
    }
}
