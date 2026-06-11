<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DruzynyController;
use App\Http\Controllers\FinanseController;
use App\Http\Controllers\HarmonogramController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PracownicyController;
use App\Http\Controllers\RozgrywkiController;
use App\Http\Controllers\SponsorzyController;
use App\Http\Controllers\StatystykiController;
use App\Http\Controllers\TreningiController;
use App\Http\Controllers\ZawodnicyController;
use Illuminate\Support\Facades\Route;



Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/show', [DruzynyController::class, 'show'])->name('show');

Route::get('/auth/register', [AuthController::class, 'goToRegister'])->name('register');

Route::post('/auth/register', [AuthController::class, 'register'])->name('register.perform');

Route::get('/zawodnicy/filter', [ZawodnicyController::class, 'pobierzWszystkichZawodnikow'])->name('zawodnicy.filter');
Route::get('/statystyki/najwiecej-goli', [StatystykiController::class, 'zawodnikNajwiecejGoli'])->name('statystyki.najwiecej_goli');
Route::get('/najlepsi-asystenci', [StatystykiController::class, 'zawodnikNajwiecejAsyst'])->name('statystyki.najwiecej_asyst');
Route::get('/statystyki/filter', [StatystykiController::class, 'pobierzWszystkieStatystyki'])->name('statystyki.filter');
Route::get('/budzety', [FinanseController::class, 'obliczBudzetDruzyn'])->name('finanse.budzety');
Route::get('/zawodnicy/druzyna/{druzyna_id}', [ZawodnicyController::class, 'pobierzZawodnikowZDruzyny'])->name('zawodnicy.z_druzyny');
Route::get('/sponsorzy/filter', [SponsorzyController::class, 'pobierzWszystkichSponsorow'])->name('sponsorzy.filter');

Route::resource('druzyny', DruzynyController::class);
Route::resource('finanse', FinanseController::class);
Route::resource('harmonogram', HarmonogramController::class);
Route::resource('pracownicy', PracownicyController::class);
Route::resource('rozgrywki', RozgrywkiController::class);
Route::resource('sponsorzy', SponsorzyController::class);
Route::resource('statystyki', StatystykiController::class);
Route::resource('treningi', TreningiController::class);
Route::resource('zawodnicy', ZawodnicyController::class);

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'login')->name('login');
    Route::post('/auth/login', 'authenticate')->name('login.authenticate');
    Route::get('/auth/logout', 'logout')->name('logout');
});

Route::get('/druzyna/{id}', [DruzynyController::class, 'pobierzDruzyne']);
Route::get('/teams', [DruzynyController::class, 'pobierzWszystkieDruzyny'])->name('teams');
Route::get('/finances', [FinanseController::class, 'pobierzWszystkieFinanse'])->name('finances');
Route::get('/schedule', [HarmonogramController::class, 'pobierzWszystkieHarmonogramy'])->name('schedule');
Route::get('/employees', [PracownicyController::class, 'pobierzWszystkichPracownikow'])->name('employees');
Route::get('/gameplay', [RozgrywkiController::class, 'pobierzWszystkieRozgrywki'])->name('gameplay');
Route::get('/sponsors', [SponsorzyController::class, 'pobierzWszystkichSponsorow'])->name('sponsors');
Route::get('/stats', [StatystykiController::class, 'pobierzWszystkieStatystyki'])->name('stats');
Route::get('/trainers', [TreningiController::class, 'pobierzWszystkieTreningi'])->name('trainers');
Route::get('/players', [ZawodnicyController::class, 'pobierzWszystkichZawodnikow'])->name('players');


Route::put('/druzyny/{id}', [DruzynyController::class, 'update'])->name('druzyny.edit');

Route::get('/stats/edit/{id}', [StatystykiController::class, 'edit'])->name('statystyki.edit');
Route::put('/stats/{id}', [StatystykiController::class, 'update'])->name('statystyki.update');

Route::get('/teams/edit/{id}', [DruzynyController::class, 'edit'])->name('druzyny.edit');
Route::put('/teams/{id}', [DruzynyController::class, 'update'])->name('druzyny.update');

Route::get('/harmonogram/{id}/edit', [HarmonogramController::class, 'edit'])->name('harmonogram.edit');
Route::put('/harmonogram/{id}', [HarmonogramController::class, 'update'])->name('harmonogram.update');
