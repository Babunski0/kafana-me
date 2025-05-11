<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model za rad sa korisnicima, registracija, autentifikacija
 */

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role'];
}
