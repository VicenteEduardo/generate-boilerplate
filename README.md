## Generate Boilerplate from SQL
Este projeto foi desenvolvido como forma de praticar e aprofundar conhecimentos no Laravel 12 e tem como objetivo agilizar o processo de criação de CRUDs a partir de um arquivo SQL.

O que o projeto faz?
Ao importar um ficheiro .sql, o sistema:

Analisa a estrutura das tabelas.

Gera automaticamente:

Migrations

Models

Controllers com métodos completos de CRUD (Create, Read, Update, Delete).

Routes prontas para uso em API ou Web.

Organiza o código gerado de forma limpa e padronizada.

Como funciona?
Faça o upload de um arquivo .sql contendo a estrutura do banco de dados.

Acompanhe o progresso através de uma barra de carregamento.

O sistema cria automaticamente todos os componentes necessários para começar o desenvolvimento.

Tecnologias utilizadas
Laravel 12

TailwindCSS (para a estilização rápida e responsiva da interface)

SweetAlert2 (para notificações elegantes de sucesso ou erro)

JavaScript (controle de upload e feedback visual)

Objetivo principal
Facilitar a vida dos desenvolvedores no início de novos projetos, reduzindo o tempo gasto em tarefas repetitivas de configuração de CRUDs básicos.

Além disso, foi uma excelente oportunidade para praticar:

Geração dinâmica de arquivos no Laravel.

Manipulação de uploads de arquivos.

Implementação de feedbacks visuais avançados com SweetAlert e barras de progresso.

Boas práticas de estruturação de projetos e automação de tarefas repetitivas.

## Instalação

git clone https://github.com/VicenteEduardo/generate-boilerplate.git
cd generate-boilerplate
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
