<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieTagController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\adminControllers\DashboardController;
use App\Http\Controllers\adminControllers\MoviesController as MovieAdminsController;
use App\Http\Controllers\adminControllers\TagController as TagAdminsController;
use App\Http\Controllers\adminControllers\MenuController as MenuAdminsController;
use App\Http\Controllers\adminControllers\UserController as UserAdminsController;
use App\Http\Controllers\adminControllers\GenreController as GenreAdminsController;
use App\Http\Controllers\adminControllers\RoleController as RoleAdminsController;

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
//rute kojima mogu svi da pristupe
Route::get ('/', [HomeController::class, 'index'])->name ('home');
Route::get ('/home', [HomeController::class, 'index'])->name ('home');
Route::get ('/about', [AboutController::class, 'index'])->name ('about');
// rute kojim je moguce pristupiti samo ukoliko korisnik nije ulogovan
Route::group (['middleware' => 'logout'], function () {
    Route::get ('/loginForm', [LoginController::class, 'index'])->name ('loginForm');
    Route::post ('/login', [LoginController::class, 'login'])->name ('login');
    Route::get ('/registerForm', [RegisterController::class, 'create'])->name ('register');
    Route::post ('/register', [RegisterController::class, 'store'])->name ('registeruser');
});
// rute kojim je moguce pristupiti samo ukoliko je korisnik ulogovan
Route::group (['middleware' => 'user'], function () {
    Route::get ('/profile', [UserController::class, 'index'])->name ('profile');
    Route::get ('/editProfileForm', [UserController::class, 'create'])->name ('editProfileForm');
    Route::post ('/editProfile', [UserController::class, 'update'])->name ('editProfile');
    Route::get ('/logout', [LoginController::class, 'destroy'])->name ('logout');
    Route::get ('/tagSearch/{id}', [MovieTagController::class, 'show'])->name ('getTags');
    Route::post ('/addTags', [MovieTagController::class, 'addTags']);
    Route::post ('/add-rating', [RatingController::class, 'store'])->name ('addRating');
    Route::post ('/delete-rating/{id}', [RatingController::class, 'destroy'])->name ('deleteRating');
});
//rute kojima mogu svi da pristupe
Route::get ('/allmovies/{movieSearch?}', [MovieController::class, 'index'])->name ('allMovies');
Route::get ('/movie-page/{id}', [MovieController::class, 'show'])->name ('oneMovie');
Route::get ('/searchMovie/pag', [MovieController::class, 'searchMovie'])->name ('searchMovie');
Route::get ('/filterMovie/{filterMovie?}', [MovieController::class, 'filterMovie'])->name ('filterMovie');
Route::get ('/contactForm', [ContactController::class, 'create'])->name ('searchMovie');
Route::post ('/contact', [ContactController::class, 'store'])->name ('searchMovie');


// rute kojima moze pristupiti samo admin

Route::group (['middleware' => 'admin'], function () {
    Route::get ('/adminPanel', [DashboardController::class, 'index'])->name ('dashboard');
    Route::get ('/filterRegister', [DashboardController::class, 'filterRegister'])->name ('dashboardRegisterFilter');
    Route::get ('/filterLogins', [DashboardController::class, 'filterLogins'])->name ('dashboardRegisterFilterLogin');
    Route::get ('/filterLogouts', [DashboardController::class, 'filterLogouts'])->name ('dashboardRegisterFilterLogout');
//movies
    Route::get ('/adminMovies', [MovieAdminsController::class, 'index'])->name ('adminMovie');
    Route::get ('/insertMovieForm', [MovieAdminsController::class, 'create'])->name ('adminMovieInsertForm');
    Route::post ('/insertMovie', [MovieAdminsController::class, 'store']);
    Route::post ('/editMovieForm/{id}', [MovieAdminsController::class, 'edit'])->name ('adminMovieEditForm');
    Route::post ('/editMovie', [MovieAdminsController::class, 'update'])->name ('adminMovieEditForm');
    Route::get ('/deleteMovie/{id}', [MovieAdminsController::class, 'destroy'])->name ('adminMovieDelete');
//tags
    Route::get ('/adminTags', [TagAdminsController::class, 'index'])->name ('adminTag');
    Route::get ('/insertTagForm', [TagAdminsController::class, 'create'])->name ('adminTagInsertForm');
    Route::post ('/insertTag', [TagAdminsController::class, 'store']);
    Route::get ('/deleteTag/{id}', [TagAdminsController::class, 'destroy'])->name ('adminTagDelete');
//menu
    Route::get ('/adminMenu', [MenuAdminsController::class, 'index'])->name ('adminTag');
    Route::get ('/insertMenuForm', [MenuAdminsController::class, 'create'])->name ('adminTagInsertForm');
    Route::post ('/insertMenu', [MenuAdminsController::class, 'store']);
    Route::get ('/editMenuForm/{id}', [MenuAdminsController::class, 'edit'])->name ('adminMovieEditForm');
    Route::get ('/editMenu/{id}', [MenuAdminsController::class, 'update'])->name ('adminMenuEditForm');
    Route::get ('/deleteMenu/{menu}', [MenuAdminsController::class, 'destroy'])->name ('adminTagDelete');
//user
    Route::get ('/adminUser', [UserAdminsController::class, 'index'])->name ('adminUser');
    Route::get ('/insertUserForm', [UserAdminsController::class, 'create'])->name ('adminUserInsertForm');
    Route::post ('/insertUser', [UserAdminsController::class, 'store']);
    Route::get ('/changeRole', [UserAdminsController::class, 'update'])->name ('adminUser');
    Route::get ('/deleteUser/{user}', [UserAdminsController::class, 'destroy'])->name ('adminUserDelete');
//message
    Route::get ('/deleteMessage/{message}', [DashboardController::class, 'destroyMessage'])->name ('adminMessageDelete');

//genres
    Route::get ('/adminGenre', [GenreAdminsController::class, 'index'])->name ('adminTag');
    Route::get ('/insertGenreForm', [GenreAdminsController::class, 'create'])->name ('adminGenreInsertForm');
    Route::post ('/insertGenre', [GenreAdminsController::class, 'store']);
    Route::get ('/editGenreForm/{id}', [GenreAdminsController::class, 'edit'])->name ('adminMovieEditForm');
    Route::get ('/editGenre/{id}', [GenreAdminsController::class, 'update'])->name ('adminMenuEditForm');
    Route::get ('/deleteGenre/{genre}', [GenreAdminsController::class, 'destroy'])->name ('adminTagDelete');
//roles
    Route::get ('/adminRole', [RoleAdminsController::class, 'index'])->name ('adminRole');
    Route::get ('/insertRoleForm', [RoleAdminsController::class, 'create'])->name ('adminRoleInsertForm');
    Route::post ('/insertRole', [RoleAdminsController::class, 'store']);
    Route::get ('/editRoleForm/{id}', [RoleAdminsController::class, 'edit'])->name ('adminRoleEditForm');
    Route::get ('/editRole/{id}', [RoleAdminsController::class, 'update'])->name ('adminRoleEditForm');
    Route::get ('/deleteRole/{role}', [RoleAdminsController::class, 'destroy'])->name ('adminRoleDelete');
});





