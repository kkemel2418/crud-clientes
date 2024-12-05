<?php

// Inicializa o ambiente Laravel
require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Cliente;

// Configura a conexão com o banco de dados
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'crud_clientes', // Troque pelo nome do seu banco de dados
    'username' => 'root', // Seu usuário de banco de dados
    'password' => '123456', // Sua senha de banco de dados
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
]);

// Configura o Eloquent ORM
$capsule->setAsGlobal();
$capsule->bootEloquent();

$clientes = [
    ['nome' => 'Cliente 12', 'cnpj' => '12345678000199', 'endereco' => 'Rua Teste 13, 12345', 'status' => 1],
    ['nome' => 'Cliente 24', 'cnpj' => '23456789000199', 'endereco' => 'Rua Teste 23, 55', 'status' => 0],
    ['nome' => 'Cliente 33', 'cnpj' => '34567890000199', 'endereco' => 'Rua Teste 33, 1414', 'status' => 1],
    ['nome' => 'Cliente 46', 'cnpj' => '45678901000199', 'endereco' => 'Rua Teste 43, 102', 'status' => 0],
    ['nome' => 'Cliente 58', 'cnpj' => '56789012000199', 'endereco' => 'Rua Teste 53, 158', 'status' => 1],
];

// Inserir os clientes no banco de dados
foreach ($clientes as $clienteData) {
    Cliente::create($clienteData);
}

echo "Clientes inseridos com sucesso!";
