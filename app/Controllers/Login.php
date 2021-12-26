<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
	public function __construct()
	{
		$this->userModel = new UserModel();
	}

	public function index()
	{
		if (session()->get('nama')) {
			return redirect()->to(base_url() . "/transaksi");
		}
		$user = $this->userModel->findAll();
		unset($user["password"]);
		$data = ['user' => $user];
		echo view('login', $data);
	}

	public function auth()
	{
		$usersModel = new UserModel();
		$username = $this->request->getPost('nama');
		$password = $this->request->getPost('password');
		$user = $usersModel->where('id', $username)->first();

		if (empty($user)) {
			session()->setFlashdata('message', '<span class="badge badge-danger">Username Salah :(</span>');
			return redirect()->to(base_url() . "/login");
		} else if (password_verify($password, $user['password'])) {
			session()->set('nama', $user["nama"]);
			session()->set('rule', $user["rule"]);
			return redirect()->to(base_url() . "/transaksi");
		} else {
			session()->setFlashdata('message', '<span class="badge badge-danger">Password Salah :(</span>');
			return redirect()->to(base_url() . "/login");
		}
	}
	public function logout()
	{
		session()->remove('nama');
		session()->remove('rule');
		return redirect()->to(base_url() . "/login");
	}
}
