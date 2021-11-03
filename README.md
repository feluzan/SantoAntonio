# Informações sobre o sistema

Esse sistema foi desenvolvido com a finalidade de controlar a utilização de auxílio estudantil e ainda está em constante evolução e adaptação.

Atualmente está sendo testado e homologado no Ifes Campus Montanha.

Dúvidas, críticas, sugestões ou perguntas devem ser enviadas para `felix.zanetti@ifes.edu.br`.

Alternativamente você pode abrir uma [Issue](https://github.com/feluzan/SantoAntonio/issues) ou, caso queira contribuir, faça um [Pull Request](https://github.com/feluzan/SantoAntonio/pulls).
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
    - Habilitar `extension: ldap` no arquivo php.ini
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
    ```
    $ composer update

    $ composer global require "laravel/installer"

    $ composer install

    $ php artisan key:generate

    $ php artisan migrate:install

    $ php artisan migrate

    $ php artisan vendor:publish

    ```

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


<br><br>
## Alteração de permissão

O sistema conta com uma gerência individual de permissão de funções, isto é, tudo que um usuário pode fazer dentro do sistema deve ser indicado de forma explícita dentro da configuração do usuário. Por isso, todas as permissões de funções são iniciadas com o status DESABILITADO para os usuários.

Para que seja possível iniciar as habilitações das funções, é necessário indicar um usuário master. É indicado que esse usuário seja uma pessoa que tenha amplo conhecimento de TODAS as funções do sistema pois ele terá todos os acessos liberados.

Para indicar o usuário master:
- Acesse o arquivo `.env`
- Edite a linha `MASTER_USER = "2157933"` para que contenha a matrícula SIAPE do usuário master.

Após atribuir as funções "Alterar permissões de acesso dos usuários", "Ver os usuários do sistema" e "Editar os usuários do sistema" para alguém, o parâmetro `MASTER_USER` pode ser permanentemente deletado.

<br><br>
## Etapas adicionais para web servers

- Ceder propriedade dos arquivos do projeto para o usuário que roda o php

    ```
    ### Debian/Ubuntu
    $ sudo chown -R www-data /path/to/laravel/files

    ### CentOS/RedHat/Fedora
    $ sudo chown -R apache /path/to/laravel/files
    ```

- Ceder permissão de escrita em diretórios:
    ```
    # Group Writable (Group, User Writable)
    $ sudo chmod -R gu+w storage

    # World-writable (Group, User, Other Writable)
    $ sudo chmod -R guo+w storage

    #####
    # The bootstrap/cache directory may need writing to also
    ##

    # Group Writable (Group, User Writable)
    $ sudo chmod -R gu+w bootstrap/cache

    # World-writable (Group, User, Other Writable)
    $ sudo chmod -R guo+w bootstrap/cache
    ```

- Ceder todas as permissões recursivamente na pasta `public/uploads`
    ```
    $ chmod 777 ./uploads/*
    ```


<br><br>
## Iniciando o sistema localmente

- Inicie o servidor do laravel 
    ```
    $ php artisan serve
    ```    

<br>
<br>


# Registro de Versões

- v0.1   
    - Versão inicial para homologação das funções do sistema.
- v0.2
    - Aprimoramento do controle de permissão,
    - Adicionada a funcionalidade de lançar tickets em dias anteriores
- v0.3
    - Inclusão de change log,
    - Criação do arquivo de configuração santoantonio.php
    - Criação de TURMA
    - Novo relatório de sumarização de tickets
    - Funcionalidade de Arquivamento de Usuário

