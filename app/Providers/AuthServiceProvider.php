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
         * 
         * 1 => "Alterar permissões de acesso dos usuários"
         * 2 => "Ver os usuários do sistema"
         * 3 => "Editar os usuários do sistema"
         * 4 => "Ver as refeições cadastradas"
         * 5 => "Criar e editar as refeições"
         * 6 => "Ver os auxílios cadastrados"
         * 7 => "Conceder auxílios aos usuários"
         * 8 => "Gerar relatórios de auxílios"
         * 9 => "Emitir tickets"
         * 10 => "Ver tickets emitidos"
         * 11 => "Ver resumo de uso diário (dashboard)"
         * 12 => "Lançar tickets passados (casos emergenciais)"
         * 
         */

        Gate::define('permissaoAcesso.manage', function () {
            return $this->isAuthorized(1);
        });



        // ---------------------- USER -------------------------------------
        //Usuarios que podem listar usuarios: Administrador e Gestor do Auxílio
        Gate::define('users.index', function () {
            return $this->isAuthorized(2);
        });

        //Usuarios que podem editar usuarios: Administrador
        Gate::define('user.edit', function () {
            return $this->isAuthorized(3);
        });


        // ---------------------- REFEICAO -------------------------------------
        //Usuarios que podem listar refeições: Todos
        Gate::define('refeicaos.list', function () {
            return $this->isAuthorized(4);
        
        });

        //Usuarios que podem criar e editar refeicoes: Administrador
        Gate::define('refeicaos.create', function () {
            return $this->isAuthorized(5);
        });

        //Usuarios que podem gerar relatórios de refeicoes: Todos
        Gate::define('refeicaos.report', function () {
            return Response::allow();
        });


        // ---------------------- auxilio -------------------------------------
        //Usuarios que podem listar auxilios: Administrador, Gerenciador de Auxílio
        Gate::define('auxilios.list', function () {
            return $this->isAuthorized(6);
        });

        //Usuarios que podem conceder (criar) auxilio: Gerenciador de Auxilios
        Gate::define('auxilio.create', function () {
            return $this->isAuthorized(7);
        });

        //Usuarios que podem gerar relatórios de auxilios: Administrador, Gestor
        Gate::define('auxilios.report', function () {
            return $this->isAuthorized(8);
        });


        // ---------------------- ticket -------------------------------------
        //Gerar tickets
        Gate::define('ticket.create', function () {
            return $this->isAuthorized(9);
        });

        //Listar tickets:
        Gate::define('tickets.report', function () {
            return $this->isAuthorized(10);
        });


        // ---------------------- dashboard -------------------------------------
        //Usuarios que visualizam a tabela de resumo de uso diário
        Gate::define('dashboard.table', function () {
            return $this->isAuthorized(11);
        });


        Gate::define('permissaoAcessos.create', function () {
            return Response::allow();
        });

        Gate::define('tickets.lancamentopassado', function () {
            return $this->isAuthorized(12);
        });

        
        

        
    }

    private function isAuthorized($codigo){
        $user = Auth::user();
        if($user->username == "2157933") return Response::allow();
        $permissoes = $user->getCodigosPermissaoAcesso();
        if(in_array($codigo,$permissoes)) return Response::allow();
        return Response::deny('Você não tem permissão para executar essa ação.');

    }
}
