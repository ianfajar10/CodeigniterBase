<?php

namespace CodeigniterBase\Database\Migrations;

use CodeIgniter\Database\Migration;

class DummyTable extends Migration
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
            'column1' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'column2' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'column3' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'column4' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'column5' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_dummy');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_dummy');
    }
}
