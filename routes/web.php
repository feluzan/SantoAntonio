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

    // Listar usuarios
    Route::group(['middleware' => 'can:user.index'], function () {
        Route::get('/user', 'UserController@index')->name('user.index');
    });

    //Editar usuario (alterar nivel de acesso)
    Route::group(['middleware' => 'can:user.edit'], function () {
        Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::patch('/user/{user}', 'UserController@update')->name('user.update');
    });


    //Criar auxilio (conceder/suspender auxílio)
    Route::group(['middleware' => 'can:auxilio.create'], function () {
        Route::get('/auxilio/{user}', 'AuxilioController@manage')->name('auxilios.manage');
        Route::delete('/auxilio/{auxilio}', 'AuxilioController@destroy')->name('auxilios.destroy');
        Route::post('/auxilio','AuxilioController@store')->name('auxilios.store');
    });
    Route::get('/auxilio', 'AuxilioController@index')->name('auxilios.index')->middleware('can:auxilios.list');
    // Route::resource('auxilios', 'AuxilioController');


    //Gerenciar Refeicoes
    Route::resource('refeicaos', 'RefeicaoController')->middleware('can:refeicao.manage');
    Route::get('/refeicaos/relatorio', 'RefeicaoController@reportBuild')->name('refeicaos.reportBuild');

    //Criar tickets
    Route::group(['middleware'=>'can:ticket.create'], function () {
        Route::get('/ticket/{refeicao}/create', 'TicketController@generate')->name('ticket.generate');
        Route::post('/tickets','TicketController@store')->name('tickets.store');
        Route::get('/tickets', 'TicketController@index')->name('tickets.index');
        // Route::get('/ticket')
        // GET           /users/create               create  users.create
    });

    // Route::resource('tickets', 'TicketController');

    //Listar tickets
    Route::group(['middleware'=>'can:ticket.list'], function () {
        Route::get('/ticket/periodo', 'TicketController@ticketsPeriodo')->name('tickets.periodo');
    });

    


    Route::post('/ticket/periodo','TicketController@reportBuild')->name('tickets.reportBuild');

    

    
    
    
    
    
    // Route::get('/auxilio/{user}', 'AuxilioController@manage')->name('auxilios.manage');
    
    // Route::get();
});




