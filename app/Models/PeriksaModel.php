<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriksaModel extends Model
{
    protected $table            = 'periksa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pasien', 'dokter', 'tgl_periksa', 'catatan'];

    // Ambil data dengan join
    public function getPeriksaWithRelations()
    {
        return $this->select('periksa.*, pasien.nama AS nama_pasien, dokter.nama AS nama_dokter')
                    ->join('pasien', 'pasien.id = periksa.pasien')
                    ->join('dokter', 'dokter.id = periksa.dokter')
                    ->findAll();
    }

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
