<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    // Exibe todos os clientes
    public function index()
    {
        $clientes = Cliente::paginate(10); // Exibe 10 clientes por página
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $clientes = Cliente::all(); // Busca todos os clientes
        return view('clientes.create', compact('clientes')); // Passa a variável $clientes para a view
    }

    public function store(Request $request)
    {
        $request['cnpj'] = preg_replace('/\D/', '', $request->cnpj);

        // Validação
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|digits:14|unique:clientes,cnpj', // Valida se tem 14 dígitos numéricos
            'endereco' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        try {
            // Criação do cliente
            Cliente::create([
                'nome' => $validated['nome'],
                'cnpj' => $validated['cnpj'],
                'endereco' => $validated['endereco'],
                'status' => $validated['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'Erro ao cadastrar cliente!');
        }
    }

    // Mostra o formulário de edição
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('clientes.index')->with('error', 'Cliente não encontrado!');
        }

        // Converte para Carbon caso não seja um objeto Carbon
      //  if ($cliente->created_at) {
           // $cliente->created_at = Carbon::parse($cliente->created_at);
       // }

        return view('clientes.edit', compact('cliente'));
    }


    public function update(Request $request, $id)
    {
        // Limpar o CNPJ para remover qualquer caractere não numérico
        $request['cnpj'] = preg_replace('/\D/', '', $request->cnpj);
    
        // Validação dos campos do cliente
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|digits:14|unique:clientes,cnpj,' . $id, // Permitir o mesmo CNPJ para o cliente atual
            'endereco' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
    
        // Iniciar a transação
        DB::beginTransaction();
    
        try {
            // Encontrar o cliente pelo ID
            $cliente = Cliente::findOrFail($id);
    
            // Atualizar o cliente
            $cliente->update([
                'nome' => $validated['nome'],
                'cnpj' => $validated['cnpj'],
                'endereco' => $validated['endereco'],
                'status' => $validated['status'],
                'updated_at' => now(),
            ]);
    
            // Confirma a transação
            DB::commit();
    
            return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
        } catch (\Exception $e) {
            // Em caso de erro, desfaz a transação
            DB::rollBack();
            return redirect()->route('clientes.index')->with('error', 'Erro ao atualizar cliente!');
        }
    }
       
    // Exclui um cliente
    public function destroy(Cliente $cliente)
    {
        // Desativar o cliente
        $cliente->update(['status' => 0]);

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
