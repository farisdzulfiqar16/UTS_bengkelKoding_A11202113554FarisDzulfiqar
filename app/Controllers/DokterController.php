<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokterModel;
use CodeIgniter\HTTP\ResponseInterface;

class DokterController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('dokter');

        $data['dokter'] = $builder->get()->getResultArray();

        $data = [
            'title' => 'Halaman dokter',
            'dokter' => $builder->get()->getResultArray(), 
            'message' => session()->getFlashdata('message') 
        ];
        return view('dokter', $data);
    }

    public function saveDokter()
    {
        if ($this->request->getMethod() === 'post') {
            $db = \Config\Database::connect();
            $builder = $db->table('dokter');

            // Tambahkan data ke database
            $builder->insert([
                'Nama' => $this->request->getPost('Nama'),
                'Alamat' => $this->request->getPost('Alamat'),
                'NoHP' => $this->request->getPost('NoHP'),
            ]);

            session()->setFlashdata('message', 'Data dokter berhasil ditambahkan!');
        }

        return redirect()->to('/dokter');
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('dokter');

        // $data['dokter'] = $builder->where('id', $id)->get()->getRowArray();
        $data['dokter'] = $builder->get()->getResultArray();
        return view('dokter_edit', $data);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('dokter');

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

        return redirect()->to('/dokter');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('dokter');

        if ($builder->delete(['id' => $id])) {
            session()->setFlashdata('message', 'Data berhasil dihapus!');
        } else {
            session()->setFlashdata('message', 'Gagal menghapus data.');
        }

        return redirect()->to('/dokter');
    }
    
}
