<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PasienController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pasien');

        $data['pasien'] = $builder->get()->getResultArray();

        $data = [
            'title' => 'Halaman Pasien',
            'pasien' => $builder->get()->getResultArray(), 
            'message' => session()->getFlashdata('message') 
        ];
        return view('pasien', $data);
    }

    public function savePasien()
    {
        if ($this->request->getMethod() === 'post') {
            $db = \Config\Database::connect();
            $builder = $db->table('pasien');

            // Tambahkan data ke database
            $builder->insert([
                'Nama' => $this->request->getPost('Nama'),
                'Alamat' => $this->request->getPost('Alamat'),
                'NoHP' => $this->request->getPost('NoHP'),
            ]);

            session()->setFlashdata('message', 'Data pasien berhasil ditambahkan!');
        }

        return redirect()->to('/pasien');
    }
    

    public function edit($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pasien');

        // $data['pasien'] = $builder->where('id', $id)->get()->getRowArray();
        $data['pasien'] = $builder->get()->getResultArray();
        return view('pasien_edit', $data);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pasien');

        $data = [
            'Nama' => $this->request->getPost('Nama'),
            'Alamat' => $this->request->getPost('Alamat'),
            'NoHP' => $this->request->getPost('NoHP'),
        ];

        if ($builder->update($data, ['id' => $id])) {
            session()->setFlashdata('message', 'Data berhasil diperbarui!');
        } else {
            session()->setFlashdata('message', 'Gagal memperbarui data.');
        }

        return redirect()->to('/pasien');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pasien');

        if ($builder->delete(['id' => $id])) {
            session()->setFlashdata('message', 'Data berhasil dihapus!');
        } else {
            session()->setFlashdata('message', 'Gagal menghapus data.');
        }

        return redirect()->to('/pasien');
    }
}
