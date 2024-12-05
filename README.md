Observação :

   - Por conta do tempo, não consegui corrigir um Bug (excluir contato). Após algumas modificações esse método apresentou erro e não conseguria ajustar até o horário da entrega.
   - CNPJ e CPF por exemplo nao tive tempo de colocaar na validação do algoritmo.
   -  Meu note não é tão rápido e acabou me tomando um tempo maior.

                                                 --------- Kelly Kemel  05/12/2024 -----------


# CRUD de Clientes

Este é um projeto de CRUD (Create, Read, Update, Delete) de clientes, desenvolvido em Laravel, com a finalidade de gerenciar informações de clientes e seus contatos. O sistema permite realizar as operações básicas de um sistema de gerenciamento de dados, além de ser facilmente expansível para incluir novas funcionalidades.

## Funcionalidades

- **Cadastro de Clientes:** Permite criar novos registros de clientes, com informações como nome, e-mail, telefone e outros dados relevantes.
- **Edição de Clientes:** Possibilita a atualização dos dados de um cliente já existente.
- **Exclusão de Clientes:** Permite excluir um cliente do sistema.
- **Exibição de Clientes:** Lista todos os clientes cadastrados no sistema.
- **Cadastro de Contatos:** Relacionado a um cliente, permite adicionar, editar ou excluir contatos associados.

## Tecnologias Utilizadas

- **Backend:** PHP com Laravel
- **Frontend:** Blade Templates (para exibição de dados no HTML)
- **Banco de Dados:** MySQL (ou outro banco relacional configurado)
- **Versionamento:** Git

## Como Rodar o Projeto

### Pré-requisitos

- **PHP** (versão 8.x ou superior)
- **Composer** (para gerenciamento de dependências do Laravel)
- **MySQL** (ou outro banco de dados relacional configurado)
- **Node.js** e **NPM** (para compilar os assets frontend)

### Passos para Instalação

1. Clone o repositório:

    ```bash
    git clone https://github.com/kkemel2418/crud-clientes.git
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd crud-clientes
    ```

3. Instale as dependências do projeto com o Composer:

    ```bash
    composer install
    ```

4. Configure o arquivo `.env` com as credenciais do banco de dados:

    - Renomeie o arquivo `.env.example` para `.env`
    - Edite as configurações do banco de dados (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD)

5. Gere a chave do aplicativo Laravel:

    ```bash
    php artisan key:generate
    ```

6. Execute as migrações para criar as tabelas no banco de dados:

    ```bash
    php artisan migrate
    ```

7. (Opcional) Se você deseja popular o banco com dados iniciais, pode rodar o seeder:

    ```bash
    php artisan db:seed
    ```

8. Execute o servidor de desenvolvimento:

    ```bash
    php artisan serve
    ```

    O sistema estará disponível em [http://localhost:8000](http://localhost:8000).

## Estrutura do Projeto

- **app/Http/Controllers:** Contém os controladores responsáveis pela lógica de negócios das rotas.
- **app/Models:** Contém os modelos que representam as tabelas do banco de dados.
- **resources/views:** Contém as views em Blade, que são responsáveis pela apresentação dos dados ao usuário.
- **routes/web.php:** Define as rotas da aplicação para o CRUD de clientes e contatos.

## Testes

O projeto inclui testes automatizados com o PHPUnit. Para rodar os testes, use o seguinte comando:

```bash
php artisan test
