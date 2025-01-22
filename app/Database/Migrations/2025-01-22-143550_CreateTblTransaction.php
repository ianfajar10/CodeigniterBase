<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblTransaction extends Migration
{
    public function up()
    {
        // Create the tbl_transaction table
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => '5',
                'null' => false
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => '5',
                'null' => false
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => false
            ]
        ]);

        // Create the table without a primary key
        $this->forge->createTable('tbl_transaction');
    }

    public function down()
    {
        // Drop the tbl_transaction table if the migration is rolled back
        $this->forge->dropTable('tbl_transaction');
    }
}
