# Sistema de Tarefas

## Objetivo do sistema:

Sistema desenvolvido para registrar tarefas.

A cada tarefa criada, será enviado um e-mail para o usuário da tarefa

As tarefas de status de pendente e completadas

Tarefas completadas não podem ser excluídas nem editadas

## Pré-requisitos:

php 8.1

node 12

## Passo a Passo para instalação:

1 - clonamos o repositório:

    git clone git@github.com:ejrtristao/todo-app.git todos-app

2 - Acessar o repositório criado

    cd todos-app

3 - Instalar as dependencias do frameword Laravel:

    ´composer update´

4 - Instalar as dependências do Vue:

    ´npm install´

5 - Configurar o banco de dados

    ´cp .env.example .env´

    ´´´
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=todo_app
    DB_USERNAME=root
    DB_PASSWORD=
    ´´´

6 - Configurar o e-mail

    ´´´
    MAIL_MAILER=smtp
    MAIL_HOST=
    MAIL_PORT=2525
    MAIL_USERNAME=
    MAIL_PASSWORD=
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=
    MAIL_FROM_NAME="${APP_NAME}"
    ´´´

7 - Gerar token do laravel

    ´php artisan key:generate´

8 - Gerar token jwt

    ´php artisan jwt:secret´

9 - Gerar migração do banco de dados

    ´php artisan migrate´

10 - Cadastrar o usuário

    ´php artisan dev:first-access´

11 - Gerar o script

    ´npm run dev´

12 - Carregar servidor

    ´php artisan serve´

## Utilizando o sistema:

### Cadastrando tarefas

1 - Faça login com seus dados

2 - acesse o botão [Nova Tarefa]

3 - Preencha os campos:

    [Tarefa] = Nome da Tarefa
    [Descrição] = Descrição detalhada da Tarefa
    Clique em
    [Salvar]

4 - Após cadastrar a tarefa, a mesma será exibida na página principal

5 - Será enviado um e-mail para o usuário da tarefa criada.

### Editando tarefas

1 - Na página principal, clique no botão editar da tarefa que deseja editar

2 - Na página de edição, insira os dados que deseja editar.

3 - salve o cadastro, os dados da tarefa atualizada irão aparecer na tela principal.

### Concluindo tarefa

1 - Na página principal, clique no botão [completar] da tarefa que deseja concluir

2 - A tarefa concluída não será mais listada na página principal

### Exibindo tarefas concluídas

1 - na página principal clique em [Tarefas Completadas]

2 - será carregada uma página com as tarefas completadas.

### Excluíndo tarefas

1 - Na página principal, clique no botão Excluir da tarefa que deseja apagar

2 - A tarefa será excluída da tela principal.
