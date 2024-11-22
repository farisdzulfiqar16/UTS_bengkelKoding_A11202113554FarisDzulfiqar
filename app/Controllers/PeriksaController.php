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
        $dokterModel = new DokterModel();
        $periksaModel = new PeriksaModel();

        $data['pasien'] = $pasienModel->findAll();
        $data['dokter'] = $dokterModel->findAll();
        $data['periksa'] = $periksaModel->getPeriksaWithRelations();

        $data['tgl_periksa'] = date('Y-m-d');
        $data['catatan'] = '';

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
        // Ambil data dari form
            $Pasien = $this->request->getPost('Pasien');
            $Dokter = $this->request->getPost('id_dokter');
            $TglPeriksa = $this->request->getPost('tgl_periksa');
            $Catatan = $this->request->getPost('catatan');
            $Obat = $this->request->getPost('obat');

        // Kode untuk menyimpan data ke database
            $db = \Config\Database::connect();
            $builder = $db->table('periksa');  
            $builder->insert([
                'pasien' => $Pasien,
                'dokter' => $Dokter,
                'tgl_periksa' => $TglPeriksa,
                'catatan' => $Catatan,
                'obat' => $Obat
            ]);


        // Menyimpan flashdata untuk memberi pesan
            session()->setFlashdata('message', 'Data pemeriksaan berhasil disimpan!');

        // Redirect ke halaman periksa dengan pesan sukses
            return redirect()->to('/periksa');
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pasien');

        $data['pasien'] = $builder->where('id', $id)->get()->getRowArray();

        return view('pasien_edit', $data);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('periksa');

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
