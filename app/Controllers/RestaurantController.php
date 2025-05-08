<?php namespace App\Controllers;

use App\Models\RestaurantModel;

class RestaurantController extends BaseController
{
    protected $model;

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

    // Čuvanje novog restorana
    public function store()
    {
        $data = $this->request->getPost([
            'name','cuisine','image_url','seats'
        ]);

        $this->model->insert($data);
        return redirect()->to('/restaurants')->with('success','Restoran dodat.');
    }

    // Brisanje
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/restaurants')->with('success','Restoran obrisan.');
    }
}
