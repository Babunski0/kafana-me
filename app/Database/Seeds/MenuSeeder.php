<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Stavke menija koje želimo da ubacimo
        $data = [
            [
                'restaurant_id' => 1,
                'item_name'     => 'Ćevapi sa kajmakom',
                'description'   => 'Klasični ćevapi sa domaćim kukuruznim lepinjama',
                'price'         => 450,
            ],
            [
                'restaurant_id' => 1,
                'item_name'     => 'Sarma',
                'description'   => 'Tradicionalna sarma punjena mlevenim mesom i pirinčem',
                'price'         => 380,
            ],
            [
                'restaurant_id' => 2,
                'item_name'     => 'Pasta ai frutti di mare',
                'description'   => 'Tjestenina sa morskim plodovima u belom vinu',
                'price'         => 520,
            ],
            [
                'restaurant_id' => 3,
                'item_name'     => 'Pečenje sa krompirom',
                'description'   => 'Svinjsko pečenje pečeno polako, uz pečeni krompir',
                'price'         => 600,
            ],
        ];

        // Isključujemo FK provere tokom ubacivanja
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        $this->db->table('menus')->insertBatch($data);
        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
    }
}
