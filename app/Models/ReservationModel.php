<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model za upravljanje rezervacijama korisnika
 */

class ReservationModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'restaurant_id', 'reserved_at'];

    protected $useTimestamps = false;
}
