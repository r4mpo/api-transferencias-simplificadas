erick agostinho (@r4mpo) - 2025

# API Transferências - Desafio Backend

## Sobre o projeto 💡

Este projeto foi desenvolvido como parte de um desafio técnico com objetivo de fixação dos estudos relacionados às boas práticas, API Restful e PHP. O objetivo principal é construir um sistema de transferência de valores entre usuários de forma segura e eficiente, garantindo integrações com serviços externos de autorização e notificação.

Para garantir uma base de código robusta e modular, o projeto foi inspirado na arquitetura proposta pelo repositório [perfect-laravel-base](https://github.com/r4mpo/perfect-laravel-base). Isso significa que a estrutura foi planejada para ser escalável, seguindo os princípios do SOLID e utilizando boas práticas de desenvolvimento. 📂🛠️

## Tecnologias utilizadas 🖥️

* **PHP 8.2.12** 🐘
* **Laravel 12.0.1** ⚡
* **MySQL** 🛢️
* **JWT (JSON Web Token) para autenticação** 🔐
* **Swagger e Postman para documentação da API** 📜

## Desafios enfrentados 🏆

Durante o desenvolvimento, alguns desafios foram encontrados e solucionados:

* **Autorização de transferências** ✅: A implementação de uma requisição a um serviço externo para validar se uma transação pode ser realizada exigiu um tratamento adequado de falhas e timeouts.
* **Controle de saldo e rollback em falhas** 🔄: Foi necessário garantir que, caso a notificação por e-mail falhasse, a transação fosse estornada corretamente para evitar inconsistências.
* **Segurança e integridade** 🔐: Implementamos middleware para validar tokens JWT, além de regras rigorosas no banco de dados para evitar transferências inválidas.
* **Código modular e escalável** 🏗️: Seguindo a arquitetura do  *perfect-laravel-base* , organizamos os serviços e repositórios para manter o código desacoplado e de fácil manutenção.

## Estrutura de pastas 📁

A estrutura do projeto foi planejada para ser intuitiva e organizada:

```
app/
├── DTO/                # Objetos de Transferência de Dados
├── Helpers/            # Funções auxiliares reutilizáveis
├── Http/
│   ├── Controllers/    # Controladores da API
│   ├── Middleware/     # Middlewares de autenticação e segurança
├── Models/             # Modelos do Eloquent
├── Repositories/       # Camada de acesso ao banco de dados
├── Services/           # Regras de negócio encapsuladas
├── ValueObjects/       # Objetos de valor utilizados nas operações
```

Essa estrutura separa claramente as responsabilidades, facilitando a escalabilidade e a manutenibilidade do projeto. 🚀

## Instalação e configuração ⚙️

1. Clone este repositório:

   ```sh
   git clone https://github.com/seu-usuario/seu-repositorio.git
   cd seu-repositorio
   ```
2. Instale as dependências:

   ```sh
   composer install
   ```
3. Configure o ambiente:

   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

   Edite o arquivo `.env` e configure os dados do banco de dados.
4. Rode as migrations:

   ```sh
   php artisan migrate --seed
   ```
5. Suba o servidor:

   ```sh
   php artisan serve
   ```

## Documentação da API 📖

A API foi documentada usando Swagger. Para acessar a documentação, basta rodar o projeto e acessar:

```
http://localhost:8000/api/documentation
```

## Testes ✅

Testes unitários foram implementados para garantir o bom funcionamento das regras de negócio.

Para rodar os testes:

```sh
php artisan test
```

## Rotas principais 🔀

### Autenticação 🔑

* `POST /user/register` - Registro de usuário
* `POST /user/login` - Login do usuário
* `GET /user/show` - Obter detalhes do usuário logado
* `GET /user/logout` - Logout do usuário

### Transferências 💰

* `POST /transfer` - Realizar uma transferência entre usuários

## Conclusão 🎯

Este projeto demonstra a capacidade de construir uma API segura, performática e bem estruturada, seguindo boas práticas e utilizando ferramentas modernas para desenvolvimento backend em Laravel. 🚀

---

Caso tenha dúvidas ou sugestões, sinta-se à vontade para contribuir! 💡✨
