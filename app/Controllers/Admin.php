<?php namespace App\Controllers;

use App\Models\RestaurantModel;

/**
 * Kontroler za administratore restorana (prikazuje, dodaje, cuva u bazi, brise restorane)
 */
class Admin extends BaseController
{

    protected function guardAdmin()
    {
        if (! session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login')->send();
        }
    }

    // Prikazuje listu svih restorana (admin role samo)
    public function index()
    {
        if (! session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $model = new \App\Models\RestaurantModel();
        $data['restaurants'] = $model->findAll();
        return view('admin/list', $data);
    }

    // Prikazuje formu za dodavanje novog restorana (admin role samo)
    public function add()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }
        return view('admin/add');
    }

    // Obradjuje POST zahtjev za dodavanje restorana, validacija unosa, cuva sliku i dodaje podatke u bazi.
    public function save()
    {
        helper(['form', 'url']);

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'     => 'required',
            'city'     => 'required',        // novo pravilo
            'cuisine'  => 'required',
            'capacity' => 'required|integer',
            'image'    => 'uploaded[image]|max_size[image,2048]|is_image[image]',
        ]);

        if (! $this->validate($validation->getRules())) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $validation->getErrors());
        }

        // Obrada fajla
        $img = $this->request->getFile('image');
        $newName = $img->getRandomName();
        $img->move(ROOTPATH . 'public/uploads', $newName);

        // Insert u bazu
        $model = new \App\Models\RestaurantModel();
        $model->insert([
            'name'      => $this->request->getPost('name'),
            'city'      => $this->request->getPost('city'),     // novo polje
            'cuisine'   => $this->request->getPost('cuisine'),
            'capacity'  => (int)$this->request->getPost('capacity'),
            'available' => (int)$this->request->getPost('capacity'),
            'image'     => $newName,
        ]);

        return redirect()->to('/admin')
                         ->with('success', 'Restoran je dodat.');
    }

    public function edit($id)
    {
        $this->guardAdmin();

        $model = new RestaurantModel();
        $data['restaurant'] = $model->findOrFail($id);

        return view('admin/edit_restaurant', $data);
    }

    //Izmjena podataka u bazi na osnovu ID-a
    public function update($id)
    {
        $this->guardAdmin();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'     => 'required',
            'city'     => 'required',
            'cuisine'  => 'required',
            'capacity' => 'required|integer',
            'image'    => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]',
        ]);

        if (! $this->validate($validation->getRules())) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $validation->getErrors());
        }

        $model = new RestaurantModel();
        $data = [
            'name'     => $this->request->getPost('name'),
            'city'     => $this->request->getPost('city'),
            'cuisine'  => $this->request->getPost('cuisine'),
            'capacity' => (int)$this->request->getPost('capacity'),
            'available'=> (int)$this->request->getPost('capacity'),
        ];

        // Ako je uploadovana nova slika, snimi je i ubaci u data
        if ($img = $this->request->getFile('image')) {
            if ($img->isValid() && ! $img->hasMoved()) {
                $newName = $img->getRandomName();
                $img->move(ROOTPATH . 'public/uploads', $newName);
                $data['image'] = $newName;
            }
        }

        $model->update($id, $data);

        return redirect()->to('/admin')
                         ->with('success', 'Restoran je uspješno ažuriran.');
    }



    // Brise restoran na osnovu ID-a (admin role samo)
    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }
        $model = new RestaurantModel();
        $model->delete($id);
        return redirect()->to('/admin')->with('success','Restoran je obrisan.');
    }
}