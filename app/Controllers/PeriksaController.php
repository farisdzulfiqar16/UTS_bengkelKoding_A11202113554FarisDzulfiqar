<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PasienModel;    // Import PasienModel
use App\Models\DokterModel;    // Import DokterModel
use App\Models\PeriksaModel;   // Import PeriksaModel

class PeriksaController extends BaseController
{
    // halaman utama
    public function index()
    {
       $pasienModel = new PasienModel();
       $data['pasien'] = $pasienModel->findAll(); 

       return view('periksa', $data);
    }

    // halaman simpan pasien
    public function savePasien()
    {
        $pasienModel = new PasienModel(); // Menggunakan PasienModel

        // Ambil data dari form
        $data = [
            'nama' => $this->request->getPost('Nama'),
            'alamat' => $this->request->getPost('Alamat'),
            'no_hp' => $this->request->getPost('NoHP')
        ];

        // Simpan data ke database
        $pasienModel->insert($data);

        // Redirect kembali ke halaman periksa dengan pesan sukses
        return redirect()->to('/periksa')->with('success', 'Data pasien berhasil disimpan');
    }

    // halaman simpan dokter
    public function saveDokter()
    {
        $dokterModel = new DokterModel(); // Menggunakan DokterModel

        // Ambil data dari form
        $data = [
            'nama' => $this->request->getPost('Nama'),
            'alamat' => $this->request->getPost('Alamat'),
            'no_hp' => $this->request->getPost('NoHP')
        ];

        // Simpan data ke database
        $dokterModel->insert($data);

        // Redirect kembali ke halaman periksa dengan pesan sukses
        return redirect()->to('/periksa')->with('success', 'Data dokter berhasil disimpan');
    }

    // halaman simpan Periksa
    public function savePeriksa()
    {
        $periksaModel = new PeriksaModel(); // Menggunakan PeriksaModel

        // Ambil data dari form
        $data = [
            'pasien' => $this->request->getPost('Pasien'),
            'dokter' => $this->request->getPost('Dokter'),
            'tgl_periksa' => $this->request->getPost('tgl_Periksa'),
            'catatan' => $this->request->getPost('catatan')
        ];

        // Simpan data ke database
        $periksaModel->insert($data);

        // Redirect kembali ke halaman periksa dengan pesan sukses
        return redirect()->to('/periksa')->with('success', 'Data pemeriksaan berhasil disimpan');
    }
}
