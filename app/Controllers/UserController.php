<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper(['form', 'url']);
        $this->user = new UserModel();
    }

    /**
     * Method utama untuk menampilkan semua data user.
     * Ini akan memuat view v_user.php
     */
    public function index()
    {
        $data['users'] = $this->user->findAll();
        // Mengirim data users ke view utama
        return view('v_user', $data); 
    }

    /**
     * Menyimpan data user baru yang dikirim dari modal 'Tambah User'.
     * Method ini tidak menampilkan view, hanya memproses data.
     */
    public function store()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $this->user->save($data);

        session()->setFlashdata('success', 'User baru berhasil ditambahkan.');
        return redirect()->to(base_url('user'));
    }

    /**
     * Memperbarui data user yang dikirim dari modal 'Edit User'.
     * Method ini juga tidak menampilkan view.
     */
    public function update($id)
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->user->update($id, $data);

        session()->setFlashdata('success', 'Data user berhasil diperbarui.');
        return redirect()->to(base_url('user'));
    }

    /**
     * Menghapus data user berdasarkan ID.
     */
    public function delete($id)
    {
        $this->user->delete($id);
        session()->setFlashdata('success', 'User berhasil dihapus.');
        return redirect()->to(base_url('user'));
    }
}