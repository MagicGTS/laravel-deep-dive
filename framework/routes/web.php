<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Symfony\Component\Yaml\Yaml;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

$yamlMenu = Yaml::parse(file_get_contents(base_path() . '/resources/js/menu.yaml'));
$menu = [];
YamlRouteRegister($yamlMenu, $menu);

foreach ($menu as $item) {
    Route::get($item['reference'], function () use ($item, $menu) {
        return Inertia::render($item['component'], [
            'title' => $item['title'],
            'menu' => $menu
        ]);
    })->name($item['component']);
}
/* Route::get('/', function () {
return Inertia::render('Index', [
'canLogin' => Route::has('login'),
'canRegister' => Route::has('register'),
'laravelVersion' => Application::VERSION,
'phpVersion' => PHP_VERSION,
'title' => "Обучение по охране труда",
]);
}); */

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
