<?php

namespace CodeigniterBase\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderDetailTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'order_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->createTable('tbl_order_details');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_order_details');
    }
}
