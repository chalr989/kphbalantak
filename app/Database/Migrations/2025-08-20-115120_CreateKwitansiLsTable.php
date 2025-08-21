<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKwitansiLsTable extends Migration
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
            'nomor_kwitansi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'penerima' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'jumlah' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'keterangan' => [
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
        $this->forge->createTable('kwitansi_ls');
    }

    public function down()
    {
        $this->forge->dropTable('kwitansi_ls');
    }
}
