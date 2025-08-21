<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratTable extends Migration
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
            'nomor_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_surat' => [
                'type' => 'DATE',
            ],
            'jenis' => [
                'type'       => 'ENUM',
                'constraint' => ['masuk', 'keluar'],
            ],
            'asal_tujuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'perihal' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'isi_ringkas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'lampiran_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'baru',
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
        $this->forge->createTable('surat');
    }

    public function down()
    {
        $this->forge->dropTable('surat');
    }
}
