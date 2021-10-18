## Instruções para Instaçação

**Pré-requisitos:**

- PHP (habilitar extension: ldap no arquivo php.ini)
- MySQL
- [Composer](https://getcomposer.org/download/)

**Procedimento**

- Clone o repositório [Versão atual](https://github.com/feluzan/SantoAntonio)
- Crie uma cópia do arquivo .env.example usando o nome .env
- Edite o arquivo .env com as configurações do seu projeto
- Rode os comandos
-- composer update
-- composer global require "laravel/installer=~1.1"
-- composer install
-- php artisan key:generate
-- php artisan migrate:install
-- php artisan migrate
-- php artisan vendor:publish

**Alterações antes de iniciar**
Antes de iniciar o sistema, altere os arquivos \config\ldap.php e \config\ldap_auth.php

**Iniciando o sistema**
Rodar o comando php artisan serve
