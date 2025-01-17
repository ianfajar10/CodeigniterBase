<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblFavorites extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
        ]);

        // Menambahkan primary key gabungan
        $this->forge->addKey(['username', 'product_id'], true);

        // Membuat tabel
        $this->forge->createTable('tbl_favorites');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_favorites');
    }
}
