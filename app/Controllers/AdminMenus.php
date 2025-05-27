<?php namespace App\Controllers;

use App\Models\RestaurantModel;
use App\Models\MenuModel;
use CodeIgniter\Controller;

/**
 * AdminMenus kontroler omogucava adminima upravljanje menijima restorana
 */

class AdminMenus extends Controller
{
    //Prikazuje listu svih restorana za koje moze da se upravlja menijima
    public function index()
    {
        $restaurants = (new RestaurantModel())->findAll();
        return view('admin/menus/index', compact('restaurants'));
    }

    //Prikazuje sve stavke menija za odredjeni restoran, stavke su grupisane po kategorijama
    public function show(int $restId)
    {
        $items = (new MenuModel())
            ->where('restaurant_id', $restId)
            ->orderBy('category','ASC')
            ->orderBy('item_name','ASC')
            ->findAll();

        $grouped = [];
        foreach ($items as $i) {
            $grouped[$i['category']][] = $i;
        }

        return view('admin/menus/show', [
            'restaurant' => (new RestaurantModel())->find($restId),
            'grouped'    => $grouped,
        ]);
    }

    //Prikazuje formu za dodavanje nove stavke menija za odredjeni restoran
    public function addItem(int $restId)
    {
        return view('admin/menus/addItem', [
            'restaurant' => (new RestaurantModel())->find($restId),
        ]);
    }

    //Cuva novu stavku menija u bazu nakon validacije unosa
    public function saveItem(int $restId)
    {
        $rules = [
          'item_name'   => 'required',
          'price'       => 'required|decimal',
          'category'    => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // insert
        (new MenuModel())->insert([
          'restaurant_id' => $restId,
          'item_name'     => $this->request->getPost('item_name'),
          'price'         => $this->request->getPost('price'),
          'description'   => $this->request->getPost('description'),
          'category'      => $this->request->getPost('category'),
        ]);

        return redirect()->to("/admin/menus/{$restId}")
                         ->with('success','Stavka je dodata.');
    }


    public function editItem(int $restId, int $itemId)
    {
        // Učitaj restoran i stavku
        $restaurant = (new RestaurantModel())->findOrFail($restId);
        $item       = (new MenuModel())->findOrFail($itemId);

        // Redoslijed kategorija kao u show()
        $order = ['Hladna predjela', 'Topla predjela', 'Corbe', 'Glavna jela', 'Dezerti'];

        return view('admin/menus/editItem', [
            'restaurant' => $restaurant,
            'item'       => $item,
            'order'      => $order,
        ]);
    }

    //Izmjena stavke menija u bazi na osnovu ID-jeva restorana i stavke
    public function updateItem(int $restId, int $itemId)
    {
        $rules = [
          'item_name'   => 'required',
          'price'       => 'required|decimal',
          'category'    => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        // Update
        (new MenuModel())->update($itemId, [
          'item_name'   => $this->request->getPost('item_name'),
          'price'       => $this->request->getPost('price'),
          'description' => $this->request->getPost('description'),
          'category'    => $this->request->getPost('category'),
        ]);

        return redirect()->to("/admin/menus/{$restId}")
                         ->with('success','Stavka je ažurirana.');
    }




    //Brise jednu stavku menija na osnovu njenog ID-a
    public function deleteItem(int $restId, int $itemId)
    {
        (new MenuModel())->delete($itemId);
        return redirect()->to("/admin/menus/{$restId}")
                         ->with('success','Stavka je obrisana.');
    }
}
