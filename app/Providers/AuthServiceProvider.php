<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\PermissaoAcesso;
use App\User;

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

        /**
         * O controle de acesso é criado de forma estática,
         * porém é atribuído de forma dinâmica.
         * 
         */

        Gate::define('permissaoAcesso.manage', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.edit_users_permission.code'));
        });

        // ---------------------- USER -------------------------------------
        //Usuarios que podem listar usuarios: Administrador e Gestor do Auxílio
        Gate::define('users.index', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.show_users.code'));
        });

        //Usuarios que podem editar usuarios: Administrador
        Gate::define('user.edit', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.edit_users.code'));
        });


        // ---------------------- REFEICAO -------------------------------------
        //Usuarios que podem listar refeições: Todos
        Gate::define('refeicaos.list', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.show_refeicao.code'));
        
        });

        //Usuarios que podem criar e editar refeicoes: Administrador
        Gate::define('refeicaos.create', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.edit_refeicao.code'));
        });

        //Usuarios que podem gerar relatórios de refeicoes: Todos
        Gate::define('refeicaos.report', function () {
            return Response::allow();
        });


        // ---------------------- auxilio -------------------------------------
        //Usuarios que podem listar auxilios: Administrador, Gerenciador de Auxílio
        Gate::define('auxilios.list', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.show_auxilio.code'));
        });

        //Usuarios que podem conceder (criar) auxilio: Gerenciador de Auxilios
        Gate::define('auxilio.create', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.edit_auxilio.code'));
        });

        //Usuarios que podem gerar relatórios de auxilios: Administrador, Gestor
        Gate::define('auxilios.report', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.report_auxilio.code'));
        });


        // ---------------------- ticket -------------------------------------
        //Gerar tickets
        Gate::define('ticket.create', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.create_ticket.code'));
        });

        //Listar tickets:
        Gate::define('tickets.report', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.show_tickets.code'));
        });


        // ---------------------- dashboard -------------------------------------
        //Usuarios que visualizam a tabela de resumo de uso diário
        Gate::define('dashboard.table', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.access_permission.code'));
        });


        Gate::define('permissaoAcessos.create', function () {
            return Response::allow();
        });

        Gate::define('tickets.lancamentopassado', function () {
            return $this->isAuthorized(config('santoantonio.access_permission.create_past_tickets.code'));
        });

        
        

        
    }

    private function isAuthorized($codigo){
        $user = Auth::user();
        if($user->username == env('MASTER_USER')) return Response::allow();
        $permissoes = $user->getCodigosPermissaoAcesso();
        if(in_array($codigo,$permissoes)) return Response::allow();
        return Response::deny('Você não tem permissão para executar essa ação.');

    }
}
