<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TambahNamaAsalKePengunjung extends Migration
{
    public function up()
    {
        // Menambah kolom 'nama' dan 'asal' ke tabel 'pengunjung'
        $this->forge->addColumn('pengunjung', [
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'id',  // Jika ingin ditempatkan setelah kolom 'id'
            ],
            'asal' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'nama',  // Jika ingin ditempatkan setelah kolom 'nama'
            ],
        ]);
    }

    public function down()
    {
        // Menghapus kolom 'nama' dan 'asal' jika rollback migration
        $this->forge->dropColumn('pengunjung', 'nama');
        $this->forge->dropColumn('pengunjung', 'asal');
    }
}
