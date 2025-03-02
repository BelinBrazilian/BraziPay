# Brazipay Starter Kit
Licença: MIT

## Requisitos
### PHP: ^8.2

- **Laravel Framework: ^12.0** – Framework PHP moderno e elegante.

- **Filament: ^3.2** – Conjunto de ferramentas para criação de aplicações web dinâmicas.

- **Laravel Horizon: ^5.30** – Gerenciamento de filas do Laravel com um painel bonito.

- **Laravel Pulse: ^1.4** – Monitoramento em tempo real das atividades da aplicação.

- **Laravel Sanctum: ^4.0** – Autenticação simples para SPAs (Single Page Applications).

- **Laravel Socialite: ^5.18** – Autenticação via redes sociais.

- **Laravel Telescope: ^5.5** – Ferramenta de debug para aplicações Laravel.

- **Laravel Tinker: ^2.10.1** – CLI interativa para Laravel.

## Requisitos de Desenvolvimento
- **FakerPHP: ^1.23** – Gerador de dados fictícios para testes.

- **Laravel Pail: ^1.2.2** – Gerenciamento de logs no Laravel.

- **Laravel Pint: ^1.21** – Ferramenta para formatação de código.

- **Laravel Sail: ^1.41** – Ambiente de desenvolvimento Docker para Laravel.

- **Mockery: ^1.6** – Ferramenta de mock para testes.

- **Collision: ^8.6** – Melhor visualização de erros no terminal.

- **PestPHP: ^3.7** – Framework de testes para PHP.

- **PestPHP Laravel Plugin: ^3.1** – Plugin do PestPHP para Laravel.

## Comandos para Subir o Sistema
Para subir o sistema utilizando o Laravel Sail, execute os seguintes comandos no terminal:

Inicialize o ambiente Docker do Sail:

```sh
./vendor/bin/sail up
```

Acesse o container do Sail:

```sh
./vendor/bin/sail shell
```

Execute as migrações do banco de dados:

```sh
sail artisan migrate
```

Execute a aplicação:

```sh
sail up
```
