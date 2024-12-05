<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContatoController extends Controller
{
    // Exibe todos os contatos
    public function index()
{
    $contacts = Contato::paginate(10);  // Carrega os contatos
    return view('contatos.index', compact('contacts'))->with('items', $contacts);  // Passa os contatos como 'items'
}


    // Exibe o formulário para criar um novo contato
    public function create()
    {
        try {
            $clientes = Cliente::all(); // Lista de clientes para associar ao contato
            return view('contatos.create', compact('clientes'));
        } catch (\Exception $e) {
            Log::error('Erro ao carregar dados para criação de contato: ' . $e->getMessage());
            return redirect()->route('contatos.index')->withErrors('Erro ao carregar os dados para criação do contato.');
        }
    }

    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'nome_contato' => 'required|string|max:255',
            'email_contato' => 'required|email|unique:contatos,email_contato',
            'fone_contato' => 'required|regex:/^\(\d{2}\) \d{5}-\d{4}$/',
            'cpf' => 'required|cpf|unique:contatos,cpf', // CPF deve ser único na tabela contatos
            'id_cliente' => 'required|exists:clientes,id',
        ]);
    
        // Criação do novo contato
        Contato::create([
            'nome_contato' => $request->nome_contato,
            'email_contato' => $request->email_contato,
            'fone_contato' => $request->fone_contato,
            'cpf' => $request->cpf,
            'id_cliente' => $request->id_cliente,
        ]);
    
        return redirect()->route('contatos.index')->with('success', 'Contato criado com sucesso!');
    }
    


    // Exibe o formulário para editar um contato existente
    public function edit(Contato $contato)
    {
        try {
            $clientes = Cliente::all();
            return view('contatos.edit', compact('contato', 'clientes'));
        } catch (\Exception $e) {
            Log::error('Erro ao carregar dados para edição de contato: ' . $e->getMessage());
            return redirect()->route('contatos.index')->withErrors('Erro ao carregar os dados para edição do contato.');
        }
    }

    public function update(Request $request, Contato $contato)
    {
        // Remover caracteres não numéricos
        $request['fone_contato'] = preg_replace('/\D/', '', $request->fone_contato); 
        $request['cpf'] = preg_replace('/\D/', '', $request->cpf); 
    
        // Validação
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'nome_contato' => 'required|string|max:255', // Removido unique, pois nomes podem ser repetidos
            'email_contato' => 'required|email|unique:contatos,email_contato,' . $contato->id . '|max:255', // Único, mas ignora o registro atual
            'fone_contato' => 'required|digits:11|unique:contatos,fone_contato,' . $contato->id, // Único, mas ignora o registro atual
            'cpf' => 'required|digits:11|unique:contatos,cpf,' . $contato->id, // Único, mas ignora o registro atual
        ]);
        
        // Atualização direta com os dados validados
        $contato->update($validated);
      
        // Redirecionamento com sucesso
        return redirect()->route('contatos.index')->with('success', 'Contato atualizado com sucesso!'); 
    }
    

    public function destroy($id)
    {
        // Verifica se o ID existe
        $contato = Contato::findOrFail($id);
        
        // Deleta o contato
        $contato->delete();
    
        // Verifica se o contato foi excluído
        dd('Contato deletado', $contato);
        
        return redirect()->route('contatos.index')->with('success', 'Contato excluído com sucesso!');
    }
    
    
    public function busca_cliente()
    {
        // Buscar todos os clientes para passar para a view de criação de contato
        $clientes = Cliente::all();
        
        return view('contatos.create', compact('clientes')); // Passa a variável $clientes para a view
    }

}
