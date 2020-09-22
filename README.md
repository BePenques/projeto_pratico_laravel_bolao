

## Bolão

Projeto de um Sistema de Bolão de Apostas Familiar desenvolvido durante o curso
<a href="https://www.udemy.com/course/projeto-pratico-com-laravel/">Projeto Prático com Laravel</a> da plataforma Udemy,
utilizando o framework PHP Laravel, com controle de acesso ACL, internacionalização e padrão repositório

## Primeiros Passos

Siga as instruções a seguir para informações sobre download, configuração e teste da aplicação em um ambiente local.

## Pré-requisitos

    - Fazer o clone do projeto
    - Composer instalado.
    - Um servidor local, com PHP na versão 7.1.3 ou superior.
    - Banco de dados¹ acessível.
    - Um navegador 

¹ A versão do Laravel utilizada no projeto (7.15.0), suporta os seguintes bancos de dados: MySQL, PostgreSQL, SQLite e SQL Server.

Clique aqui para mais detalhes e configuração: https://laravel.com/docs/7.x/database


## Instalação

Inicie um terminal (CMD, prompt de comando) na pasta do projeto e execute o seguinte comando: composer install


## Configuração

Renomeie o arquivo .env.example para apenas .env

Altere o conteúdo deste arquivo, atualizando as informações de conexão, conforme exemplo:

    ...
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=NOME_DO_BANCO
    DB_USERNAME=USUARIO_DO_BANCO
    DB_PASSWORD=SENHA_DO_BANCO
    ...

Crie o banco de dados definido no endereço acima.

Com o SGBD no ar, pelo terminal, na pasta do projeto:

    - Execute php artisan key:generate  - para dicionar uma hash de segurança no arquivo .env

    - Execute php artisan migrate - para efetivar as migrações (cria as tabelas no banco)
    
## Iniciar a aplicação

Para iniciar a aplicação, execute o comando: php artisan serve pelo terminal, na pasta do projeto.

A aplicação estará disponível no endereço indicado (por padrão, o endereço http://127.0.0.1:8000 é utilizado).

Opcional: na pasta do projeto, execute o seguinte comando - php artisan db:seed (para gerar os registros iniciais)

Obs:. SuperAdmin login: superadmin@mail.com | senha: admin123
      Gerente    login: gerente@mail.com | senha: gerente123

## Notas

Projeto(em desenvolvimento) para fins de estudo e utilização do framework PHP Laravel, em Aplicações Web.
