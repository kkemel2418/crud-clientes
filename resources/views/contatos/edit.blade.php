@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Editar Contato</h1>

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

        <!-- Exibir mensagens de sucesso ou erro -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulário -->
        <form action="{{ route('contatos.update', $contato->id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select id="id_cliente" name="id_cliente" class="form-select" required>
                    <option value="">Selecione um cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" 
                            {{ old('id_cliente', $contato->id_cliente) == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="mb-3">
                <label for="nome_contato" class="form-label">Nome do Contato</label>
                <input type="text" id="nome_contato" name="nome_contato" class="form-control"
                       value="{{ old('nome_contato', $contato->nome_contato) }}" required>
            </div>
        
            <div class="mb-3">
                <label for="email_contato" class="form-label">Email do Contato</label>
                <input type="email" id="email_contato" name="email_contato" class="form-control"
                       value="{{ old('email_contato', $contato->email_contato) }}" required>
            </div>
        
            <div class="mb-3">
                <label for="fone_contato" class="form-label">Telefone</label>
                <input type="text" id="fone_contato" name="fone_contato" class="form-control"
                       value="{{ old('fone_contato', $contato->fone_contato) }}" required>
            </div>
        
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" id="cpf" name="cpf" class="form-control"
                       value="{{ old('cpf', $contato->cpf) }}" required>
            </div>

            <!-- Campos para exibição do created_at e updated_at -->
        <div class="row mb-3">
            <div class="col-12">
                <label for="created_at" class="form-label">Criado em</label>
                <input type="text" id="created_at" class="form-control" 
                    value="{{ $contato->created_at ? $contato->created_at->format('d/m/Y H:i:s') : 'Não disponível' }}" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="updated_at" class="form-label">Atualizado em</label>
                <input type="text" id="updated_at" class="form-control" 
                    value="{{ $contato->updated_at ? $contato->updated_at->format('d/m/Y H:i:s') : 'Não disponível' }}" disabled>
            </div>
        </div>

        
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- Adicionar máscara de CPF e Telefone -->
    <script>
        // Máscara de CPF
        document.getElementById('cpf').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '').replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4');
        });

        // Máscara de Telefone
        document.getElementById('fone_contato').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '').replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
        });
    </script>
@endpush
