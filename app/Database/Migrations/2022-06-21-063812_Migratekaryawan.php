<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratekaryawan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_karyawan'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true,],
            'nama_karyawan'      => ['type' => 'VARCHAR', 'constraint' => '100',],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_karyawan', true);
        $this->forge->createTable('karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('karyawan');
    }
}
