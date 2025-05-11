<?php namespace App\Controllers;

use App\Models\RestaurantModel;

/**
 * Kontroler koji upravlja kreiranjem i brisanjem restorana
 */

class RestaurantController extends BaseController
{
    protected $model;

    //Konstruktor - ucitava model i form helper
    public function __construct()
    {
        $this->model = new RestaurantModel();
        helper('form');
    }

    // Prikaz forme za dodavanje
    public function create()
    {
        return view('restaurants/create');
    }

    //Cuva podatke unijete iz forme i upisuje novi restoran u bazu
    public function store()
    {
        $data = $this->request->getPost([
            'name','cuisine','image_url','seats'
        ]);

        $this->model->insert($data);
        return redirect()->to('/restaurants')->with('success','Restoran dodat.');
    }

    //Brisanje restorana po ID-u
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/restaurants')->with('success','Restoran obrisan.');
    }
}
