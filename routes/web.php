<?php

use function Laravel\Prompts\search;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BukuController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\Auth\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');

Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth', 'role:internal_reviewer|admin'])->group(function () {
    Route::get('reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// Menampilkan daftar semua reviewer
Route::get('reviewers', [ReviewController::class, 'listReviewers'])->name('reviews.listReviewers');
Route::get('reviewer/{id}', [ReviewController::class, 'byReviewer'])->name('reviews.byReviewer');
Route::get('tags', [ReviewController::class, 'listTags'])->name('reviews.listTags');
Route::get('tag/{tag}', [ReviewController::class, 'byTag'])->name('reviews.byTag');


// fitur rating
Route::middleware(['auth'])->group(function () {
    Route::post('/books/{book}/rate', [RatingController::class, 'store'])->name('books.rate');
    Route::get('/books/{book}', [RatingController::class, 'show'])->name('books.detail');
});

// favourite
Route::middleware('auth')->group(function () {
    Route::post('/books/{id}/favourite', [FavouriteController::class, 'addToFavourite'])->name('books.favourite');
    Route::get('/buku/myfavourite', [FavouriteController::class, 'myFavourites'])->name('books.myfavourites');
});
