<?php

namespace App\Controllers;

use App\Models\ChatModel;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'testing web chat',
			'ip' => ''
		];
		return view('home', $data);
	}
	public function set()
	{
		session()->set('user', $this->request->getVar('user'));
		return redirect()->to(base_url());
	}
	public function kirim()
	{
		$req = $this->request->getVar();
		$simpan = $this->chatModel->save([
			'user' => session()->get('user'),
			'pesan' => $req['pesan']
		]);
		$data = [
			'success' => false
		];
		if ($simpan) {
			$data = [
				'success' => true
			];
		}
		return $this->response->setJSON($data);
	}
	public function read()
	{
		$read = $this->chatModel->findAll();
		return $this->response->setJSON($read);
	}
	//--------------------------------------------------------------------

}
