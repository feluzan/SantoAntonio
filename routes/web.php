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

/*
Quando usa-se ::resource (exemplo para users)
Verb          Path                        Action  Route Name
GET           /users                      index   users.index
GET           /users/create               create  users.create
POST          /users                      store   users.store
GET           /users/{user}               show    users.show
GET           /users/{user}/edit          edit    users.edit
PUT|PATCH     /users/{user}               update  users.update
DELETE        /users/{user}               destroy users.destroy
*/

Route::redirect('/', '/home', 301);

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('user', 'UserController');
  
    Route::get('/ticket/{refeicao}/create', 'TicketController@generate')->name('ticket.generate');

    Route::resource('refeicaos', 'RefeicaoController');

    Route::resource('tickets', 'TicketController');

    Route::resource('auxilios', 'AuxilioController');
    Route::get('/auxilio/{user}', 'AuxilioController@manage')->name('auxilios.manage');
    // Route::get();
});




