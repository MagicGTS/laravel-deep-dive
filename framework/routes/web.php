<?php

use App\Http\Controllers\CourceController;
use App\Http\Controllers\NewsSubscriptionController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\Yaml\Yaml;
use App\Http\Controllers\Admin\NewsParserController;
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
            'display' => array_key_exists('display', $item) ? $item['display'] : $item['title'],
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
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

Route::get('/cource/{slug}', [CourceController::class, 'index'])->name('Cource');

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

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard'); */
Route::group(['prefix' => 'admin', 'name'=>'Admin.', 'middleware' => ['auth:sanctum', 'verified','admin']],function () {
    Route::get('parse', [NewsParserController::class, 'parse'])->name('Parse');
    
    Route::get('newseditor/{guid}', [NewsParserController::class, 'edit'])->name('NewsEditor');
    Route::get('newslist', [NewsParserController::class, 'index'])->name('NewsList');
    Route::post('newsedit', [NewsParserController::class, 'update'])->name('NewsUpdate');
});

Route::post('/emailnewssubscribe', [NewsSubscriptionController::class, 'subscribe'])->name('emailnewssubscribe');

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('Google-redirect');

Route::get('/auth/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::where('google_id', $googleUser->id)->first();

    if ($user) {
        $user->update([
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);
    } else {
        $user = User::updateOrCreate([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);
    }

    Auth::login($user);

    return redirect('/');

    // $user->token
})->name('Google-callback');
