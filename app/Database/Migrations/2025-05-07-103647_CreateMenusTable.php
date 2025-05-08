<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenusTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'restaurant_id'  => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'item_name'      => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'price'          => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'category'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'Glavna jela',
            ],
            'description'    => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // Definišemo RAW SQL za created_at:
            "created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP"
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('restaurant_id');
        $this->forge->addForeignKey('restaurant_id', 'restaurants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('menus');
    }

    public function down()
    {
        $this->forge->dropTable('menus');
    }
}
