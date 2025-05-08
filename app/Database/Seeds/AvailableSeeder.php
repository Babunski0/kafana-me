<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AvailableSeeder extends Seeder
{
    public function run()
    {
        // Dohvatamo query builder za tabelu restaurants
        $builder = $this->db->table('restaurants');

        // Za svaku kolonu capacity postavi available na isti broj
        $builder->set('available', 'capacity', false)  // false -> ne escapuje kapacitet, radi raw SQL
                ->update();
    }
}
