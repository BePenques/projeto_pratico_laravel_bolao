<?php

use Illuminate\Support\Facades\Route;

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

Route::get('lang', function () {
    $lang = session('lang', 'pt-br');
    if($lang == 'pt-br')
    {
      $lang = "en";
    }
    else
    {
      $lang = "pt-br";
    }
     session(['lang' => $lang]);
    return redirect()->back();

})->name('lang');

//rota para alterar a linguagem
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//  $this->middleware('auth'); proteger os metodos sob autenticação
Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function () {

  Route::resource('/users', 'UserController');
  Route::resource('/create', 'UserController');

});
