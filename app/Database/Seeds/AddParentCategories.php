<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddParentCategories extends Seeder
{
    public $table = 'categories';

    public function run()
    {
        $data = [
            [
                'name' => 'Category A',
                'parent_id' => 0
            ],
            [
                'name' => 'Category B',
                'parent_id' => 0
            ]

        ];


        $this->db->table($this->table)->insertBatch($data);
    }
}
