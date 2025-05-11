<?php namespace App\Controllers;

use App\Models\RestaurantModel;

/**
 * Kontroler za administratore restorana (prikazuje, dodaje, cuva u bazi, brise restorane)
 */

class Admin extends BaseController
{
    //Prikazuje listu svih restorana (admin role samo)
    public function index()
    {
        if (! session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $model = new \App\Models\RestaurantModel();
        $data['restaurants'] = $model->findAll();
        return view('admin/list', $data); 
    }

    //Prikazuje formu za dodavanje novog restorana (admin role samo)
    public function add()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }
        return view('admin/add');
    }

    //Obradjuje POST zahtjev za dodavanje restorana, validacija unosa, cuva sliku i dodaje podatke u bazi.
    public function save()
    {
        helper(['form', 'url']);

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'     => 'required',
            'cuisine'  => 'required',
            'capacity' => 'required|integer',
            'image'    => 'uploaded[image]|max_size[image,2048]|is_image[image]',
        ]);

        if (! $this->validate($validation->getRules())) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $validation->getErrors());
        }

        // obrada fajla
        $img = $this->request->getFile('image');
        $newName = $img->getRandomName();
        $img->move(ROOTPATH . 'public/uploads', $newName);

        // insert u bazu
        $model = new \App\Models\RestaurantModel();
        $model->insert([
            'name'      => $this->request->getPost('name'),
            'cuisine'   => $this->request->getPost('cuisine'),
            'capacity'  => (int)$this->request->getPost('capacity'),
            'available' => (int)$this->request->getPost('capacity'),
            'image'     => $newName,
        ]);

        return redirect()->to('/admin')
                        ->with('success', 'Restoran je dodat.');
    }



    //Brise restoran na osnovu ID-a (admin role samo)
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
