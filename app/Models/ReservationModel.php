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
    protected $allowedFields = [
        'user_id', 
        'restaurant_id', 
        'people', 
        'meal_type', 
        'reservation_time', 
        'created_at'];

    protected $useTimestamps = false;
}
