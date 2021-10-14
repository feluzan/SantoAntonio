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

Route::get('/keys','KeyController@index')->name('keys.index');
Route::get('/keys/create','KeyController@create')->name('keys.create');
Route::post('/keys','KeyController@store')->name('keys.store');
Route::get('/keys/{key}','KeyController@show')->name('keys.show');
Route::get('/keys/{key}/edit','KeyController@edit')->name('keys.edit');
Route::pacth('/keys/{key}','KeyController@update')->name('keys.update');
Route::delete('/keys/{key}','KeyController@destroy')->name('keys.destroy');
*/

Route::redirect('/', '/home', 301);

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::group(['middleware' => 'auth'], function () {


    /* ------------- ROTAS USER -----------------------------
    /* - Listar usuarios (index)
    /* - Editar usuario (edit/update)
    /* ---------------------------------------------------------*/
    Route::get('/users', 'UserController@index')->name('users.index')->middleware('can:users.index');
    Route::group(['middleware' => 'can:user.edit'], function () {
        Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::patch('/user/{user}', 'UserController@update')->name('user.update');
    });

    /* ------------- ROTAS REFEICAO -----------------------------
    /* - Listar refeicoes (index)
    /* - Criar e editar refeicoes (create/store e edit/update)
    /* - Relatório de refeicoes (reportBuild)
    /* ---------------------------------------------------------*/
    Route::get('/refeicaos', 'RefeicaoController@index')->name('refeicaos.index')->middleware('can:refeicaos.list');
    Route::group(['middleware' => 'can:refeicaos.create'], function () {
        Route::get('/refeicaos/create','RefeicaoController@create')->name('refeicaos.create');
        Route::post('/refeicaos','RefeicaoController@store')->name('refeicaos.store');
        Route::get('/refeicaos/{refeicao}/edit','RefeicaoController@edit')->name('refeicaos.edit');
        Route::patch('/refeicaos/{refeicao}','RefeicaoController@update')->name('refeicaos.update');
    });
    Route::get('/refeicaos/relatorio', 'RefeicaoController@reportBuild')->name('refeicaos.reportBuild')->middleware('can:refeicaos.report');


    /* ------------- ROTAS AUXILIO -----------------------------
    /* - Listar auxilio (index)
    /* - Criar (conceder) auxilio (manage/store)
    /* - Deletar (suspender) auxilio (destroy)
    /* ---------------------------------------------------------*/
    Route::get('/auxilio', 'AuxilioController@index')->name('auxilios.index')->middleware('can:auxilios.list');
    Route::group(['middleware' => 'can:auxilio.create'], function () {
        Route::get('/auxilio/{user}', 'AuxilioController@manage')->name('auxilios.manage');
        Route::post('/auxilio','AuxilioController@store')->name('auxilios.store');
        Route::delete('/auxilio/{auxilio}', 'AuxilioController@destroy')->name('auxilios.destroy');
    });
    Route::get('/auxilios/relatorio', 'AuxilioController@reportBuild')->name('auxilios.reportBuild')->middleware('can:auxilios.report');
    // Route::get('/auxilio', 'AuxilioController@index')->name('auxilios.index')->middleware('can:auxilios.list');
    // Route::resource('auxilios', 'AuxilioController');


    /* ------------- ROTAS TICKET -----------------------------
    /* - Gerar tickets (index) (generate/store)
    /* - Consultar relatório (reportIndex/reportBuild)
    /* - Sumarização de tickets (sumaryIndex/sumaryBuild)
    /* ---------------------------------------------------------*/
    Route::group(['middleware'=>'can:ticket.create'], function () {
        Route::get('/ticket/{refeicao}/create', 'TicketController@generate')->name('ticket.generate');
        Route::get('/tickets/{refeicao}/create/{assistido}', 'TicketController@confirmview')->name('ticket.confirmview');
        Route::post('/tickets/confirm', 'TicketController@confirm')->name('ticket.confirm');
        Route::post('/tickets','TicketController@store')->name('tickets.store');
    });
    Route::get('/tickets', 'TicketController@reportIndex')->name('tickets.reportIndex')->middleware('can:tickets.report');
    Route::post('/tickets/report','TicketController@reportBuild')->name('tickets.reportBuild')->middleware('can:tickets.report');;

    Route::get('/tickets/sumario', 'TicketController@sumaryIndex')->name('tickets.sumaryIndex')->middleware('can:tickets.report');
    Route::post('/tickets/sumario/report','TicketController@sumaryBuild')->name('tickets.sumaryBuild')->middleware('can:tickets.report');;


    /* ------------- ROTAS PERMISSAO ACESSO -----------------------------
    /* 
    /* ---------------------------------------------------------*/
    Route::group(['middleware'=>'can:permissaoAcesso.create'], function () {
        // Route::get('/permissaoAcessos/{user}/create', 'PermissaoAcessoController@generate')->name('permissaoAcessos.generate');
        
        
    });
    Route::get('/permissaoAcesso', 'PermissaoAcessoController@index')->name('permissaoAcessos.index');
    Route::post('/permissaoAcessos','PermissaoAcessoController@store')->name('permissaoAcessos.store')->middleware('can:permissaoAcesso.manage');
    Route::delete('/permissaoAcessos/{permissaoAcesso}', 'PermissaoAcessoController@destroy')->name('permissaoAcessos.destroy')->middleware('can:permissaoAcesso.manage');
});



// Route::resource('permissaoAcessos', 'PermissaoAcessoController');

