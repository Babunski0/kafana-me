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
        'city',
        'cuisine',
        'capacity',
        'available',
        'image',        
        'created_at',   
    ];

    protected $useTimestamps = false;

    /**
     * Pronalazi red po ID-ju ili baca 404
     *
     * @param int|string $id
     * @return array
     * @throws PageNotFoundException
     */
    public function findOrFail($id)
    {
        $row = $this->find($id);
        if (! $row) {
            throw PageNotFoundException::forPageNotFound("Restoran sa ID-jem {$id} ne postoji");
        }
        return $row;
    }


}
