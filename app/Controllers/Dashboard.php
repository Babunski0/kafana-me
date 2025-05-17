<?php namespace App\Controllers;

use App\Models\RestaurantModel;
use App\Models\ReservationModel;
use App\Models\MenuModel;

/**
 * Ovaj kontroler prikazuje glavne stranice za korisnika, omogucava rezervaciju restorana
 * otkazivanje rezervacije, pregled menija i liste restorana
 */

class Dashboard extends BaseController
{
    // Prikaz glavne stranice sa preporucenim restoranima
    public function index()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Uzima se 3 najnovija restorana kao preporucena
        $recommended = (new RestaurantModel())
            ->orderBy('created_at', 'DESC')
            ->findAll(3);

        return view('dashboard', [
            'username'    => session()->get('username'),
            'role'        => session()->get('role'),
            'restaurants' => $recommended,
        ]);
    }


    //Prikaz svih restorana 
    public function restaurants()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        return view('restaurants/list', [
            'restaurants' => (new RestaurantModel())->findAll(),
            'role'        => session()->get('role'),
        ]);
    }

    //Funkcija za rezervaciju restorana
    public function reserve(int $id)
    {
        helper('form');

        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Morate se prijaviti.');
        }

        $userId    = session()->get('user_id');
        $restModel = new RestaurantModel();
        $resModel  = new ReservationModel();

        // Fetch restaurant
        $rest = $restModel->find($id);
        if (! $rest) {
            return redirect()->back()->with('error', 'Restoran nije pronađen.');
        }

        // Prevent duplicate reservation
        if ($resModel->where('user_id', $userId)->where('restaurant_id', $id)->first()) {
            return redirect()->to('/reservations')->with('error', 'Već ste rezervisali ovaj restoran.');
        }

        if (strtolower($this->request->getMethod()) === 'post') {
            // Validate inputs
            $rules = [
                'people'           => 'required|integer|greater_than[0]|less_than_equal_to[' . $rest['available'] . ']',
                'meal_type'        => 'required|in_list[dorucak,rucak,vecera]',
                'reservation_time' => 'required|regex_match[/^(?:[01]\d|2[0-3]):[0-5]\d$/]',
            ];
            if (! $this->validate($rules)) {
                return view('reserve_form', ['validation' => $this->validator, 'restaurant' => $rest]);
            }

            // Update availability
            $people = (int) $this->request->getPost('people');
            $restModel->update($id, ['available' => $rest['available'] - $people]);

            // Insert reservation
            $resModel->insert([
                'user_id'          => $userId,
                'restaurant_id'    => $id,
                'people'           => $people,
                'meal_type'        => $this->request->getPost('meal_type'),
                'reservation_time' => $this->request->getPost('reservation_time'),
                'reservation_date' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/reservations')->with('success', 'Rezervacija uspješna!');
        }

        // Show form
        return view('reserve_form', ['restaurant' => $rest]);
    }

        



    //Ajax poziv koji provjerava da li korisnik vec ima rezervaciju
    public function checkReservation(int $restaurantId)
    {
        if (! session()->get('isLoggedIn')) {
            return $this->response->setStatusCode(401);
        }

        $exists = (new \App\Models\ReservationModel())
            ->where('user_id', session()->get('user_id'))
            ->where('restaurant_id', $restaurantId)
            ->first() !== null;

        return $this->response->setJSON(['exists' => $exists]);
    }

    //Prikaz aktivnih rezervacija
    public function reservations()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $reservations = (new ReservationModel())
            ->select('reservations.id, restaurants.name AS restaurant_name, reservations.people, reservations.meal_type, reservations.reservation_time')
            ->join('restaurants', 'restaurants.id = reservations.restaurant_id')
            ->where('reservations.user_id', session()->get('user_id'))
            ->orderBy('reservations.reservation_date', 'DESC')
            ->findAll();

        return view('reservations', [
            'reservations' => $reservations,
        ]);
    }

    //Otkazivanje rezervacije
    public function cancel(int $id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Morate se prijaviti.');
        }

        $userId = session()->get('user_id');
        $rModel  = new ReservationModel();
        $res     = $rModel->find($id);

        if (! $res || $res['user_id'] !== $userId) {
            return redirect()->to('/reservations')
                             ->with('error', 'Ne možete otkazati ovu rezervaciju.');
        }

        //Povecava broj dostupnih mjesta
        $restModel  = new RestaurantModel();
        $restaurant = $restModel->find($res['restaurant_id']);
        if ($restaurant) {
            $restModel->update($restaurant['id'], [
                'available' => $restaurant['available'] + $res['people'],
            ]);
        }

        //Brisanje rezervacije
        $rModel->delete($id);

        return redirect()->to('/reservations')
                         ->with('success', 'Rezervacija je otkazana.');
    }

    //Prikaz menija za sve restorane
    public function menus()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $username = session()->get('username');

        $restaurants = (new RestaurantModel())->findAll();
        $mModel      = new MenuModel();

        $menusByRestaurant = [];
        foreach ($restaurants as $rest) {
            $menusByRestaurant[] = [
                'restaurant' => $rest,
                'items'      => $mModel
                    ->where('restaurant_id', $rest['id'])
                    ->orderBy('item_name', 'ASC')
                    ->findAll(),
            ];
        }

        return view('menus', [
            'username'          => $username,
            'menusByRestaurant' => $menusByRestaurant,
        ]);
    }
}
