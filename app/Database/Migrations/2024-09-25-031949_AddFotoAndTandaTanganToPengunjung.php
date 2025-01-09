<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFotoAndTandaTanganToPengunjung extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pengunjung', [
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'tanda_tangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pengunjung', 'foto');
        $this->forge->dropColumn('pengunjung', 'tanda_tangan');
    }
}
