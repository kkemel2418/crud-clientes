@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Editar Cliente</h1>

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
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $cliente->nome) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cnpj" class="form-label">CNPJ</label>
                    <input type="text" id="cnpj" name="cnpj" class="form-control" value="{{ old('cnpj', $cliente->cnpj) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" value="{{ old('endereco', $cliente->endereco) }}" required>
                </div>
            </div>

            <!-- Campos para exibição do created_at e updated_at -->
        <div class="row mb-3">
            <div class="col-12">
                <label for="created_at" class="form-label">Criado em</label>
                <input type="text" id="created_at" class="form-control" 
                    value="{{ $cliente->created_at ? $cliente->created_at->format('d/m/Y H:i:s') : 'Não disponível' }}" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="updated_at" class="form-label">Atualizado em</label>
                <input type="text" id="updated_at" class="form-control" 
                    value="{{ $cliente->updated_at ? $cliente->updated_at->format('d/m/Y H:i:s') : 'Não disponível' }}" disabled>
            </div>
        </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="1" {{ old('status', $cliente->status) == 1 ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ old('status', $cliente->status) == 0 ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Cliente</button>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- Adicionar máscara de CNPJ -->
    <script>
        // Máscara de CNPJ
        document.getElementById('cnpj').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '').replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, '$1.$2.$3/$4-$5');
        });
    </script>
@endpush
