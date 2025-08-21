<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSppdTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_spt' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'nomor_sppd' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'pelaksana' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'perihal' => [
                'type' => 'TEXT',
                'null' => true,
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('sppd');
    }

    public function down()
    {
        $this->forge->dropTable('sppd');
    }
}
