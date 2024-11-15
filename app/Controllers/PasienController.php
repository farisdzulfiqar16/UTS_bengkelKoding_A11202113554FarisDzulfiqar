<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PasienController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Pasien',
            'form_action' => 'pasien/save', 
            'Nama' => '',
            'Alamat' => '',
            'NoHP' => '',
            'message' => session()->getFlashdata('message')
        ];
        return view('pasien', $data);
    }

    public function savePasien()
    {
        // Validasi dan simpan data
        $Nama = $this->request->getPost('Nama');
        $Alamat = $this->request->getPost('Alamat');
        $NoHP = $this->request->getPost('NoHP');

        // Kode untuk menyimpan ke database
        $db = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->insert([
            'Nama' => $Nama,
            'Alamat' => $Alamat,
            'NoHP' => $NoHP
        ]);

        session()->setFlashdata('message', 'Data pasien berhasil disimpan!');
        return redirect()->to('/pasien');
    }
}
