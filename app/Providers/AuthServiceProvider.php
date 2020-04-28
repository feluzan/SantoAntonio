<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Níveis no banco de dados
        // 100 => God mode (inserir manualmente no banco)
        // 0 => 'Sem Funções',
        // 1 => 'Administrador',
        // 2 => 'Gestor do Auxílio',
        // 3 => 'Restaurante',
        // 4 => 'Consultas de Relatórios',


        //Usuarios que podem listar usuarios: Administrador e Gestor do Auxílio
        Gate::define('user.index', function () {
            $user = Auth::user();
            if($user->level==100 || $user->level==1 || $user->level==2) return Response::allow();
            return Response::deny('Você precisa ser um Administrador ou um Gestor de Auxílio para acessar essa função.');
        });

        //Usuarios que podem editar usuarios: Administrador
        Gate::define('user.edit', function () {
            $user = Auth::user();
            if($user->level==100 || $user->level===1) return Response::allow();
            return Response::deny('Você precisa ser um Administrador para acessar essa função.');
        });

        //Usuarios que podem conceder (criar) auxilio: Gerenciador de Auxilios
        Gate::define('auxilio.create', function () {
            $user = Auth::user();
            if($user->level==100 || $user->level===2) return Response::allow();
            return Response::deny('Você precisa ser um Gerenciador de Auxilio para acessar essa função.');
        });
        //Usuarios que podem listar auxilios: Administrador, Gerenciador de Auxílio
        Gate::define('auxilios.list', function () {
            $user = Auth::user();
            if($user->level==100 || $user->level===1 || $user->level===2) return Response::allow();
            return Response::deny('Você precisa ser um Administrador ou um Gerenciador de Auxílio para acessar essa função.');
        });

        //Usuarios que podem gerenciar refeições: Administrador
        Gate::define('refeicao.manage', function () {
            $user = Auth::user();
            if($user->level==100 || $user->level===1) return Response::allow();
            return Response::deny('Você precisa ser um Administrador para acessar essa função.');
        });

        //Listar tickets:
        Gate::define('ticket.list', function () {
            $user = Auth::user();
            if(in_array($user->level,array(100,1,2,3))) return Response::allow();
            return Response::deny('Você precisa ser um Administrador para acessar essa função.');
        });

        Gate::define('ticket.create', function () {
            $user = Auth::user();
            if(in_array($user->level,array(100,3))) return Response::allow();
            return Response::deny('Você precisa ser um Restaurante para acessar essa função.');
        });

        
    }
}
