<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdminTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => [
                'type'           => 'INT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'   => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'username'   => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'picture'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'password'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'role'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'token'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tb_admin');

        $data = [
            'name' => 'Super Admin',
            'username' => 'halo',
            'password' => password_hash('ThankyouNext!', PASSWORD_BCRYPT),
            'role' => 'superadmin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('tb_admin')->insert($data);
    }

    public function down()
    {
        $this->forge->dropTable('tb_admin');
    }
}
