<?php

use App\Http\Controllers\SitemapController;
use App\Http\Controllers\CourcesController;
use App\Http\Controllers\QuickCourcesController;
use App\Http\Controllers\Admin\NewsParserController;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('sitemap', [SitemapController::class, 'index']);
Route::get('cources', [CourcesController::class, 'index']);
Route::get('quickcources', [QuickCourcesController::class, 'index']);

//Route::get('phpinfo', [PhpinfoController::class, 'show']);
