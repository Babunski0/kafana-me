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
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Morate se prijaviti.');
        }

        $userId = session()->get('user_id');
        $resModel = new \App\Models\ReservationModel();

        // Provjera da li već postoji rezervacija
        $already = $resModel
            ->where('user_id', $userId)
            ->where('restaurant_id', $id)
            ->first();
        if ($already) {
            return redirect()->back()
                            ->with('error', 'Već ste rezervisali ovaj restoran.');
        }

        // Provjera dostupnih mjesta
        $restModel = new \App\Models\RestaurantModel();
        $rest      = $restModel->find($id);
        if (! $rest || $rest['available'] < 1) {
            return redirect()->back()->with('error', 'Nema slobodnih mesta.');
        }

        // Smanji available za 1
        $restModel->update($id, ['available' => $rest['available'] - 1]);

        // Upis rezervacije
        $resModel->insert([
            'user_id'          => $userId,
            'restaurant_id'    => $id,
            'reservation_date' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/restaurants')
                        ->with('success', 'Uspešno rezervisano mesto.');
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

        $data['reservations'] = (new ReservationModel())
            ->select('reservations.id, restaurants.name AS restaurant_name')
            ->join('restaurants', 'restaurants.id = reservations.restaurant_id')
            ->where('reservations.user_id', session()->get('user_id'))
            ->orderBy('reservations.reservation_date', 'DESC')
            ->findAll();

        return view('reservations', $data);
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
                'available' => $restaurant['available'] + 1,
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
