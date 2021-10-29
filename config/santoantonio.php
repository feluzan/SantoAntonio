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
    'current_version' => "v0.3",

    /*
    |--------------------------------------------------------------------------
    | CONTROLE DE ALTERAÇÕES
    |--------------------------------------------------------------------------
    |
    | Registro de alterações de acordo com as versões
    */

    'change_log' => [
        'v0.1' => [
            "Versão inicial do sistema.",
            "Funcionalidades básicas adicionadas",
        ],
        'v0.2' => [
            "Aprimoramento do controle de permissão",
            "Adicionada a funcionalidade de lançar tickets em dias anteriores"
        ],
        'v0.3' => [
            "Inclusão de change log.",
            "Criação do arquivo de configuração santoantonio.php",
            "Criação de TURMA"
        ],
    ],


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

        'show_turmas' => [
            'code' => 13,
            'desc' => "Visualizar turmas cadastradas",
        ],

        'editar_arquivados' => [
            'code' => 14,
            'desc' => "Listar e editar usuários arquivados",

        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | PERÍODOS DOS CURSOS
    |--------------------------------------------------------------------------
    | Referem-se aos períodos disponíveis para cadastro de turmas
    | Matutino / Vespertino / Noturno / Integral
    */
    'periodo' => [
        "MATUTINO" => "MATUTINO",
        "VESPERTINO" => "VESPERTINO",
        "NOTURNO" => "NOTURNO",
        "INTEGRAL" => "INTEGRAL",
    ],
];

