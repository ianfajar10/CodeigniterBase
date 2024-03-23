<?php

namespace CodeigniterBase\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'table' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'total_amount' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_orders');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_orders');
    }

}
