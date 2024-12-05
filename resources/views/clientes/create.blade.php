@extends('layouts.app')

@section('title', 'Cadastrar Cliente')

@section('content')
    <div class="mt-5">
        <h1 class="mb-4">Cadastrar Cliente</h1>

        <!-- Exibir erros de validação -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário -->
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="cnpj" class="form-label">CNPJ</label>
                    <input type="text" id="cnpj" name="cnpj" class="form-control" value="{{ old('cnpj') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" id="endereco" name="endereco" class="form-control" value="{{ old('endereco') }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>

        
            <div class="d-flex justify-content-between">
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Máscara para o campo CNPJ
            const cnpjInput = document.getElementById('cnpj');
            cnpjInput.addEventListener('input', function () {
                let value = cnpjInput.value.replace(/\D/g, ''); // Remove tudo que não é dígito
                value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
                cnpjInput.value = value.substring(0, 18); // Limita ao formato "XX.XXX.XXX/XXXX-XX"
            });

            // Adicionar mais contatos dinamicamente
            let contatoCount = 1;
            document.getElementById('addContato').addEventListener('click', function() {
                contatoCount++;
                let divContatos = document.createElement('div');
                divContatos.innerHTML = `
                    <div class="mb-3">
                        <label for="nome_contato_${contatoCount}" class="form-label">Nome do Contato</label>
                        <input type="text" id="nome_contato_${contatoCount}" name="contatos[${contatoCount}][nome_contato]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_contato_${contatoCount}" class="form-label">Email</label>
                        <input type="email" id="email_contato_${contatoCount}" name="contatos[${contatoCount}][email_contato]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fone_contato_${contatoCount}" class="form-label">Telefone</label>
                        <input type="text" id="fone_contato_${contatoCount}" name="contatos[${contatoCount}][fone_contato]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpf_${contatoCount}" class="form-label">CPF</label>
                        <input type="text" id="cpf_${contatoCount}" name="contatos[${contatoCount}][cpf]" class="form-control" required>
                    </div>
                `;
                document.getElementById('contatos').appendChild(divContatos);
            });
        });
    </script>
@endsection
