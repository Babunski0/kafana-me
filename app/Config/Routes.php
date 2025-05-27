<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes = Services::routes();

// Iskljuci auto-route
$routes->setAutoRoute(false);

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// --- PUBLIC RUTE ---
$routes->get('login',     'Auth::login');
$routes->post('login',    'Auth::loginPost');
$routes->get('register',  'Auth::register');
$routes->post('register', 'Auth::registerPost');

// --- RUTE ZA ULOGOVANE KORISNIKE (user ili admin) ---
$routes->group('', function(RouteCollection $r){
    $r->get('/',               'Dashboard::index');
    $r->get('dashboard',       'Dashboard::index');
    $r->get('restaurants',     'Dashboard::restaurants');
    $r->get('check-reservation/(:num)', 'Dashboard::checkReservation/$1');
    $r->match(['get','post'], 'reserve/(:num)', 'Dashboard::reserve/$1');
    $r->get('reservations',    'Dashboard::reservations');
    $r->get('cancel/(:num)',   'Dashboard::cancel/$1');
    $r->get('menus',           'Dashboard::menus');
    $r->get('contact',         'Dashboard::contact');
    $r->get('logout',          'Auth::logout');
});

// --- RUTE ZA ADMIN KORISNIKE ---
$routes->group('admin', function(RouteCollection $r){
    // CRUD za restorane
    $r->get(  '',              'Admin::index');
    $r->get(  'add',           'Admin::add');
    $r->post( 'save',          'Admin::save');
    $r->get(   'restaurants/(:num)/edit',       'Admin::edit/$1');
    $r->post(  'restaurants/(:num)/update',     'Admin::update/$1');
    $r->get(   'delete/(:num)', 'Admin::delete/$1');

    // Upravljanje menijima
    $r->get(  'menus',                     'AdminMenus::index');
    $r->get(  'menus/(:num)',              'AdminMenus::show/$1');
    $r->get(  'menus/(:num)/add',          'AdminMenus::addItem/$1');
    $r->post( 'menus/(:num)/add',          'AdminMenus::saveItem/$1');

    $r->get('menus/(:num)/items/(:num)/edit',   'AdminMenus::editItem/$1/$2');
    $r->post('menus/(:num)/items/(:num)/update', 'AdminMenus::updateItem/$1/$2');
    
    $r->get(  'menus/(:num)/delete/(:num)', 'AdminMenus::deleteItem/$1/$2');
});
