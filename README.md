# Informações sobre o sistema

Esse sistema foi desenvolvido com a finalidade de controlar a utilização de auxílio estudantil e ainda está em constante evolução e adaptação.

Atualmente está sendo testado e homologado no Ifes Campus Montanha.

Dúvidas, críticas, sugestões ou perguntas devem ser enviadas para `felix.zanetti@ifes.edu.br`.

<br><br>

# O Santo Antônio

Santo Antônio foi um Doutor da Igreja que viveu na viragem dos séculos XII e XIII. Foi canonizado em 30 de maio de 1232 pelo Papa Gregório IX. Sua festa liturica é celebrada em 13 de junho (data de seu óbito em 1231).

Trecho da oração à Santo Antônio:

    Santo Antônio, amigo dos pobres,
    peço-te a graça de nunca faltar pão e alimento em nossa mesa.
    Prometo-lhe, por minha vez,
    olhar sempre para os mais necessitados,
    repartindo com eles o pão que nos mandares,
    através do trabalho honesto.[...]


<br><br>
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

<br>
<br>




