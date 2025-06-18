<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('v_users', $data);
    }

    public function save()
    {
        $userModel = new UserModel();
        $userModel->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role')
        ]);
        return redirect()->to('/users')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $userModel->update($id, [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role')
        ]);
        return redirect()->to('/users')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/users')->with('success', 'Data berhasil dihapus.');
    }
}