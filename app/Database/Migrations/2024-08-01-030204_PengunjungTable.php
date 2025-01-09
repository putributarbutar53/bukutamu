<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PengunjungTable extends Migration
{
    public function up()
    {
        // Membuat tabel dengan kolom-kolom awal
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'tanda_tangan' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_pengunjung');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pengunjung');
    }
}
