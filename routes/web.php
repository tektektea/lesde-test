<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\WebResourceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//
//Route::get('/', [DashboardController::class, 'test']);
Route::get('/', fn() => Inertia::render('IndexPage'));
Route::get('/admin', fn() => Inertia::render('Backend/DashboardPage'));

Route::get('/setting', fn() => Inertia::render('Backend/Setting/SettingPage'))->name('setting');


Route::group(['prefix' =>'web-resource'], function () {
    Route::get('privacy', [WebResourceController::class, 'privacy'])
        ->name('privacy.read');
    Route::get('term', [WebResourceController::class, 'term'])
        ->name('term.read');
    Route::get('edit/{type}', [WebResourceController::class, 'edit'])
        ->middleware('auth')
        ->name('web-resource.edit');
    Route::put('{type}', [WebResourceController::class, 'update'])
        ->middleware('auth')
        ->name('web-resource.update');
});

Route::group(['prefix' =>'/dashboard','middleware'=>'auth'], function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' =>''], function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login:store');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');
});

Route::resource('faq', FaqController::class)->middleware('auth');
Route::resource('state', StateController::class)->middleware('auth');
Route::resource('district', DistrictController::class)->middleware('auth');

Route::put('faq/{faq}/publish', [FaqController::class,'togglePublish'])->middleware('auth')->name('faq.publish');


//Route::get('/', function () {
//    return Inertia::render('welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
//
//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//require __DIR__.'/auth.php';
Route::get('/access-denied', fn() => Inertia::render('Errors/AccessDeniedPage'))->name('access-denied');
