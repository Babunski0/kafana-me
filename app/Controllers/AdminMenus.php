<?php namespace App\Controllers;

use App\Models\RestaurantModel;
use App\Models\MenuModel;
use CodeIgniter\Controller;

class AdminMenus extends Controller
{
    public function index()
    {
        // lista restorana
        $restaurants = (new RestaurantModel())->findAll();
        return view('admin/menus/index', compact('restaurants'));
    }

    public function show(int $restId)
    {
        // sve stavke menija za restoran, grupisane po category
        $items = (new MenuModel())
            ->where('restaurant_id', $restId)
            ->orderBy('category','ASC')
            ->orderBy('item_name','ASC')
            ->findAll();

        // grupiši PHP-om u [category => [stavka,...], ...]
        $grouped = [];
        foreach ($items as $i) {
            $grouped[$i['category']][] = $i;
        }

        return view('admin/menus/show', [
            'restaurant' => (new RestaurantModel())->find($restId),
            'grouped'    => $grouped,
        ]);
    }

    public function addItem(int $restId)
    {
        // prikaži formu, prosledi restaurant_id
        return view('admin/menus/addItem', [
            'restaurant' => (new RestaurantModel())->find($restId),
        ]);
    }

    public function saveItem(int $restId)
    {
        // validacija...
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

    public function deleteItem(int $restId, int $itemId)
    {
        (new MenuModel())->delete($itemId);
        return redirect()->to("/admin/menus/{$restId}")
                         ->with('success','Stavka je obrisana.');
    }
}
