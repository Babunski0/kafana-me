<?php namespace App\Models;

use CodeIgniter\Model;

class RestaurantModel extends Model
{
    protected $table      = 'restaurants';
    protected $primaryKey = 'id';

    // Dodaj sve kolone koje želiš da možeš masovno upisivati/updejtuješ
    protected $allowedFields = [
        'name',
        'cuisine',
        'capacity',
        'available',
        'image',        // ako koristiš polje za sliku
        'created_at',   // ako želiš
    ];

    // Ako ti ne treba automatsko timestampovanje,
    // možeš ga isključiti
    protected $useTimestamps = false;
}
