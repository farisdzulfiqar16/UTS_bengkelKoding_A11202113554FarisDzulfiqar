<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokterModel;
use CodeIgniter\HTTP\ResponseInterface;

class DokterController extends BaseController
{
    public function index()
    {
        $dokterModel = new DokterModel();
        $data['dokter'] = $dokterModel->findAll();  // Ambil semua data dokter

        return view('dokter_view', $data);
    }

    public function saveDokter()
    {
        $dokterModel = new DokterModel();

        // Ambil data dari form
        $data = [
            'nama' => $this->request->getPost('Nama'),
            'alamat' => $this->request->getPost('Alamat'),
            'no_hp' => $this->request->getPost('NoHP')
        ];

        // Simpan data ke database
        $dokterModel->insert($data);

        // Redirect kembali ke halaman dokter dengan pesan sukses
        return redirect()->to('/dokter')->with('success', 'Data Dokter berhasil disimpan');
    }
}
