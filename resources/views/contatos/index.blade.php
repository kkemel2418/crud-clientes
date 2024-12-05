@extends('layouts.app')

@section('content')
    <h1>Contatos</h1>

    <!-- Mensagens de Feedback -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('contatos.create') }}" class="btn btn-primary">Adicionar Novo Contato</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contato)
                <tr>
                    <td>{{ $contato->nome_contato }}</td>
                    <td>{{ $contato->email_contato }}</td>
                    <td>{{ $contato->fone_contato }}</td>
                    <td class="cpf">{{ $contato->cpf }}</td>
                    <td>
                        <!-- Botão Editar -->
                        <a href="{{ route('contatos.edit', $contato->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        
                        <!-- Botão Excluir (Inicia Modal de Confirmação) -->
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $contato->id }}">
                            <i class="fas fa-trash"></i> Excluir
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="mt-3">
        {{ $contacts->links() }} <!-- Paginação usando a variável 'contacts' -->
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir este contato? Esta ação não pode ser desfeita.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!-- Formulário de Exclusão -->
                    <form id="deleteForm" action="#" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> Excluir
                        </button>
                    </form>
                    
                                     
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function () {
            // Aplica máscara no CPF ao carregar a página
            $('.cpf').each(function () {
                var cpf = $(this).text();
                if (cpf.length === 11) {
                    $(this).text(cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'));
                }
            });

            $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botão que acionou o modal
            var id = button.data('id'); // Pega o ID do contato
            var action = "/contatos/" + id; // Define a URL de exclusão

            // Atualiza a ação do formulário com o ID correto
            $('#deleteForm').attr('action', action);
        });

        });
    </script>
@endsection
