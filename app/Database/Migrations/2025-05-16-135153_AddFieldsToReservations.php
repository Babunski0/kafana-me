<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToReservations extends Migration
{
    public function up()
    {
        $fields = [
            'people'           => [
                'type'       => 'INT',
                'constraint' => 3,
                'unsigned'   => true,
                'default'    => 1,
            ],
            'meal_type'        => [
                'type'    => 'ENUM("dorucak","rucak","vecera")',
                'default' => 'rucak',
            ],
            'reservation_time' => [
                'type'    => 'TIME',
                'default' => '12:00:00',
            ],
        ];
        $this->forge->addColumn('reservations', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('reservations', ['people','meal_type','reservation_time']);
    }
}
