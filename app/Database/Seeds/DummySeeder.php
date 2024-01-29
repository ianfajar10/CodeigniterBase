<?php

namespace CodeigniterBase\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DummySeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            $data = [
                'column1' => 'Value1-' . $i,
                'column2' => 'Value2-' . $i,
                'column3' => 'Value3-' . $i,
                'column4' => 'Value4-' . $i,
                'column5' => 'Value5-' . $i,
            ];

            // Using Query Builder to insert data
            $this->db->table('tbl_dummy')->insert($data);
        }
    }
}
