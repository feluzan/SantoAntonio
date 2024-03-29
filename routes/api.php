<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::resource('user_roles', 'UserRolesAPIController');

Route::resource('refeicaos', 'RefeicaoAPIController');

Route::resource('tickets', 'TicketAPIController');

Route::resource('auxilios', 'AuxilioAPIController');

Route::resource('permissao_acessos', 'PermissaoAcessoAPIController');

Route::resource('turmas', 'TurmaAPIController');
