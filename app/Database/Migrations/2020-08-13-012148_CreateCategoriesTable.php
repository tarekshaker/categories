<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'parent_id' => [
                'type' => 'int',
                'unsigned' => true
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('categories');
    }


}