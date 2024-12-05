@extends('layouts.app')

@section('title', 'Cadastrar Contato')

@section('content')
    <div class="mt-5">
        <h1 class="mb-4">Cadastrar Contato</h1>

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
        <form action="{{ route('contatos.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome_contato" class="form-label">Nome</label>
                    <input type="text" id="nome_contato" name="nome_contato" class="form-control" value="{{ old('nome_contato') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" value="{{ old('cpf') }}" required placeholder="000.000.000-00">
                </div>
            </div>

            <div class="mb-3">
                <label for="email_contato" class="form-label">Email</label>
                <input type="email" id="email_contato" name="email_contato" class="form-control" value="{{ old('email_contato') }}" required>
            </div>

            <div class="mb-3">
                <label for="fone_contato" class="form-label">Celular/WhatsApp</label>
                <input type="text" id="fone_contato" name="fone_contato" class="form-control" value="{{ old('fone_contato') }}" required placeholder="(99) 99999-9999">
            </div>

            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select name="id_cliente" id="id_cliente" class="form-select" required>
                    <option value="">Selecione um cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('id_cliente') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('contatos.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@endsection
