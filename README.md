# Instruções para Instaçação

## Pré-requisitos

- PHP
    - Habilitar `extension: ldap` no arquivo php.ini)
- MySQL
- [Composer](https://getcomposer.org/download/)


## Procedimento

- Clone o repositório ([versão atual](https://github.com/feluzan/SantoAntonio))
- Crie uma cópia do arquivo `.env.example` usando o nome `.env`
- Edite o arquivo `.env` e insira as informações do seu projeto nas variáveis:
    - `APP_URL`
    - `DB_HOST`
    - `DB_PORT`
    - `DB_DATABASE`
    - `DB_USERNAME`
    - `DB_PASSWORD`

- Rode os comandos a seguir
    - `composer update`
    - `composer global require "laravel/installer=~1.1"`
    - `composer install`
    - `php artisan key:generate`
    - `php artisan migrate:install`
    - `php artisan migrate`
    - `php artisan vendor:publish`

- Acesse o arquivo `\config\ldap.php` e certifique-se de configurar corretamente os seguintes parâmetros do array `connections->default->settings`:
    - `account_prefix` : `''`
    - `account_suffix` : `@cefetes.br`
    - `hosts` : IP do seu controlador de domínio
    - `base_dn` : Caminho base para pesquisas no LDAP (exemplo: `OU=Campus Montanha,DC=cefetes,DC=br`)
    - `username` : Usuário para consulta ao LDAP
    - `password` : Senha do usuário para consulta ao LDAP

- Acesse o arquivo `\config\ldap_auth.php` e certifique-se de configurar corretamente os seguintes parâmetros do array:
    - `identifiers->ldap->locate_users_by` : `samaccountname`
    - `identifiers->ldap->bind_users_by` : `samaccountname`
    - `identifiers->database->guid_column` : `objectguid`
    - `identifiers->database->username_column` : `username`
    - `identifiers->windows->locate_users_by` : `samaccountname`
    - `passwords->sync` : `true`
    - `passwords->column` : `password`



## Iniciando o sistema

Inicie o servidor do laravel com o comando `php artisan serve`
