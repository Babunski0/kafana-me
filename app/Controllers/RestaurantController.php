<?php namespace App\Controllers;

use App\Models\RestaurantModel;

/**
 * Kontroler koji upravlja prikazom, kreiranjem i brisanjem restorana
 */
class RestaurantController extends BaseController
{
    protected $model;

    // Konstruktor – učitava model i form helper
    public function __construct()
    {
        $this->model = new RestaurantModel();
        helper('form');
    }

    // Prikaz liste restorana
    public function index()
    {
        // Selektujemo i grad pored ostalih polja
        $restaurants = $this->model
            ->select('id, name, image, cuisine, capacity, available, city')
            ->findAll();

        return view('restaurants/list', [
            'restaurants' => $restaurants
        ]);
    }

    // Prikaz forme za dodavanje
    public function create()
    {
        return view('restaurants/create');
    }

    // Čuva podatke unete iz forme i upisuje novi restoran u bazu
    public function store()
    {
        $input = $this->request->getPost([
            'name',
            'city',
            'cuisine',
            'image_url',
            'seats',
        ]);

        $data = [
            'name'      => $input['name'],
            'city'      => $input['city'],
            'cuisine'   => $input['cuisine'],
            'image'     => $input['image_url'],
            'capacity'  => (int)$input['seats'],
            'available' => (int)$input['seats'],
        ];

        $this->model->insert($data);

        return redirect()
            ->to('/restaurants')
            ->with('success', 'Restoran dodat.');
    }

    // Brisanje restorana po ID-u
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()
            ->to('/restaurants')
            ->with('success', 'Restoran obrisan.');
    }
}
