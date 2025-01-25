<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblRates extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'rate' => [
                'type' => 'INT',
                'constraint' => 1,
                'unsigned' => true,
            ]
        ]);
        $this->forge->createTable('tbl_rates');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_rates');
    }
}
