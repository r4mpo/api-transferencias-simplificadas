
# API Transferências - Desafio Backend **🚀**

## Sobre o projeto 💡

Este projeto foi desenvolvido como parte de um desafio técnico com objetivo de fixação dos estudos relacionados às boas práticas, API Restful e PHP. O objetivo principal é construir um sistema de transferência de valores entre usuários de forma segura e eficiente, garantindo integrações com serviços externos de autorização e notificação.

Para garantir uma base de código robusta e modular, o projeto foi inspirado na arquitetura proposta pelo repositório [perfect-laravel-base](https://github.com/r4mpo/perfect-laravel-base). Isso significa que a estrutura foi planejada para ser escalável, seguindo os princípios do SOLID e utilizando boas práticas de desenvolvimento. 📂🛠️

## Tecnologias utilizadas 🖥️

* **PHP 8.2.12** 🐘
* **Laravel 12.0.1** ⚡
* **MySQL** 🛢️
* **JWT (JSON Web Token) para autenticação** 🔐
* **Swagger e Postman para documentação da API** 📜
* **PHPUnit para Testes Automatizados** ⚙️

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
│   ├── Requests/       # Validam informações de formulários
├── Interfaces/         # Possibilitam templates padronizados para scripts
├── Models/             # Modelos do Eloquent
├── Queries/            # Armazenam queries mais complexas
├── Repositories/       # Camada de acesso ao banco de dados
├── Services/           # Regras de negócio encapsuladas
├── Swagger/            # Comentários de Documentação da API
├── ValueObjects/       # Objetos de valor utilizados nas operações
├── Utils/              # Validações de tipos específicos de dados
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

O projeto foi documentado utilizando Postman e Swagger. Para acessar a collection, basta verificar o arquivo em ./collection. E para acessar a documentação, basta rodar o projeto e acessar:

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

### Extrato 📋

* `GET /stratuns` - Consulta histórico de transações do usuário logado

## Considerações técnicas ✍️

Durante o desenvolvimento do projeto, adotei uma série de boas práticas que considero fundamentais em aplicações modernas:

* **Desacoplamento de funções** : Priorizei o desacoplamento entre responsabilidades por meio do uso de serviços, repositórios, interfaces e objetos de valor (Value Objects), garantindo uma estrutura coesa, testável e de fácil manutenção.
* **Escolha do Laravel** : Utilizei o Laravel como framework principal por ser o mais popular e consolidado no ecossistema PHP. Sua ampla documentação, comunidade ativa e integração com ferramentas modernas o tornam ideal para projetos robustos.
* **Validações criteriosas** : Implementei validações rigorosas em requests, serviços e regras de negócio para assegurar que apenas dados consistentes fossem processados ao longo da aplicação.
* **Segurança no endpoint de transferências** : Como sugestão de melhoria à especificação proposta na atividade, recomendo que o campo `payer` não seja enviado no corpo da requisição. Em vez disso, o próprio back-end deve inferir o `payer` a partir do usuário autenticado via JWT. Essa abordagem mitiga riscos de fraudes e evita transferências em nome de terceiros.
* **Código limpo e organizado** : Busquei manter o código limpo, legível e modular, com atenção especial à estruturação de diretórios e à separação clara de responsabilidades.
* **Criação de endpoint complementar `/stratuns`** : Como extensão do desafio, desenvolvi um endpoint adicional que permite ao usuário autenticado consultar seu extrato detalhado, incluindo informações de status, tipo de operação (pagou ou recebeu) e valores. Essa funcionalidade oferece maior transparência ao histórico financeiro do usuário.
* **Cobertura de testes automatizados** : Ambos os endpoints principais foram devidamente cobertos por testes automatizados utilizando PHPUnit, reforçando a confiabilidade da aplicação.

## Conclusão 🎯

Este projeto demonstra a capacidade de construir uma API segura, performática e bem estruturada, seguindo boas práticas e utilizando ferramentas modernas para desenvolvimento backend em Laravel. 🚀

---

Caso tenha dúvidas ou sugestões, sinta-se à vontade para contribuir! 💡✨

*erick agostinho (@r4mpo) - 2025*
