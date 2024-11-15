<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ControllerPoliklinik extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function pasien()
    {
        return view('pasien');
    }

    public function dokter()
    {
        return view('dokter');
    }

    public function periksa()
    {
        return view('periksa');
    }
}
