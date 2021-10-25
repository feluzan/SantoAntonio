<?php
/**
 * Informações globais da versão do Sistema SANTO ANTÔNIO
 * 
 * NÃO ALTERE ESSE ARQUIVO
 * NÃO ALTERE ESSE ARQUIVO
 * NÃO ALTERE ESSE ARQUIVO
 * NÃO ALTERE ESSE ARQUIVO
 * NÃO ALTERE ESSE ARQUIVO
 * NÃO ALTERE ESSE ARQUIVO
 * NÃO ALTERE ESSE ARQUIVO
 * NÃO ALTERE ESSE ARQUIVO
 * NÃO ALTERE ESSE ARQUIVO
 * NÃO ALTERE ESSE ARQUIVO
 * 
 */
return [

    /*
    |--------------------------------------------------------------------------
    | VERSÃO ATUAL DO SISTEMA
    |--------------------------------------------------------------------------
    |
    | Registro da versão atual do Sistema.
    */
    'current_version' => "v0.2",


    /*
    |--------------------------------------------------------------------------
    | CÓDIGOS DE PERMISSÃO DE ACESSO
    |--------------------------------------------------------------------------
    |
    | Especifica os códigos de permissão de acesso às funcionalidades do
    | sistema.
    | Esse códigos são usados pelo AuthServiceProvider.php para liberar ou não 
    | o acesso à determinada função.
    | Todos os códigos devem ter uma descrição sucinta do que é a funcionalidade
    | pois essa descrição é exibida na tela de gerência de permissões.
    */
    'access_permission' => [
        'dashboard' => [
            'code' => 11,
            'desc' => "Ver resumo de uso diário (dashboard)"
        ],
        'show_users' => [
            'code' => 2,
            'desc' => "Ver os usuários do sistema"
        ],
        'edit_users' => [
            'code' => 3,
            'desc' => "Editar os usuários do sistema"
        ],
        'edit_users_permission' => [
            'code' => 1,
            'desc' => "Alterar permissões de acesso dos usuários"
        ],

        'show_refeicao' => [
            'code' => 4,
            'desc' => "Ver as refeições cadastradas"
        ],
        'edit_refeicao' => [
            'code' => 5,
            'desc' => "Criar e editar as refeições"
        ],

        'show_auxilio' => [
            'code' => 6,
            'desc' => "Ver os auxílios cadastrados"
        ],
        'edit_auxilio' => [
            'code' => 7,
            'desc' => "Conceder auxílios aos usuários"
        ],
        'report_auxilio' => [
            'code' => 8,
            'desc' => "Gerar relatórios de auxílios"
        ],

        'create_ticket' => [
            'code' => 9,
            'desc' => "Emitir tickets"
        ],
        'show_tickets' => [
            'code' => 10,
            'desc' => "Ver tickets emitidos"
        ],

        'create_past_tickets' => [
            'code' => 12,
            'desc' => "Lançar tickets passados (casos emergenciais)"
        ],

    ],
];


/* 1 => "Alterar permissões de acesso dos usuários"
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
    * */