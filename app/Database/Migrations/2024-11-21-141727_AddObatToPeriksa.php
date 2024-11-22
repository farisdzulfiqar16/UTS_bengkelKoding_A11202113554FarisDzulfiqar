<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddObatToPeriksa extends Migration
{
    public function up()
    {
        $this->forge->addColumn('periksa', [
            'obat' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('periksa', 'obat');
    }
}
