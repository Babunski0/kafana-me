<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * Model za rad sa tabelom 'restaurants'
 */

class RestaurantModel extends Model
{
    protected $table      = 'restaurants';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'cuisine',
        'capacity',
        'available',
        'image',        
        'created_at',   
    ];

    protected $useTimestamps = false;
}
