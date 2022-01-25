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
YamlRouteList($yamlMenu, $menu);

foreach ($menu as $item) {
    Route::get($item['reference'], function () use ($item, $menu) {
        return Inertia::render($item['component'], [
            'title' => $item['title'],
            'menu' => $menu,
            'display' => array_key_exists('display', $item) ? $item['display'] : $item['title']
        ]);
    })->name($item['component']);
}

$yamlMenu = Yaml::parse(file_get_contents(base_path() . '/resources/js/SliderCources.yaml'));
$menu = [];
YamlRouteList($yamlMenu, $menu);
foreach ($menu as $item) {
    Route::get($item['reference'], function () use ($item) {
        return Inertia::render($item['component'], [
            'title' => $item['title'],
            'display' => array_key_exists('display', $item) ? $item['display'] : $item['title'],
        ]);
    })->name($item['component']);
}

Route::get('/location', function () {
    return Inertia::render('Index', [
        'title' => "Как нас найти",
    ]);
})->name('Location');

Route::get('/stub', function () {
    return Inertia::render('Index', [
        'title' => "Не реализовано",
    ]);
})->name('Stub'); 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
