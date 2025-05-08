<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,

        // Додај ове две линије:
        'auth'          => \App\Filters\AuthFilter::class,
        'role'          => \App\Filters\RoleFilter::class,
    ];

    public array $globals = [
        'before' => [
            'forcehttps',
            'pagecache',
            // овде немој да стављаш auth/role као глобалне
        ],
        'after'  => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [
        // по потреби, овде можеш да региструјеш 
        // auth филтер за све dashboard руте:
        //
        // 'auth' => ['before' => [
        //     'dashboard', 'restaurants', 'menus', 
        //     'reservations', 'reserve/*', 'contact'
        // ]],
        //
        // али пошто си их већ ставио у рутере преко групе, 
        // ово није обавезно.
    ];
}
