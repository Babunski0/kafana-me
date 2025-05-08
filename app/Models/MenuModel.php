<?php namespace App\Models;
use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table      = 'menus';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'restaurant_id','item_name','price','description','category'
    ];
}
