<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Página Inicial')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Mask Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

</head>
<body>

    <div class="d-flex">
        <!-- Menu lateral -->
        <div class="bg-dark text-white p-3" style="width: 250px;">
            <h3>Menu</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('clientes.index') }}">
                        <i class="fas fa-home"></i> Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('clientes.index') }}">
                        <i class="fas fa-users"></i> Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('contatos.index') }}">
                        <i class="fas fa-address-book"></i> Contatos
                    </a>
                </li>
            </ul>
        </div>
        

        <!-- Conteúdo principal -->
        <div class="container-fluid p-4" style="flex-grow: 1;">
            @yield('content')
        
            <!-- Paginação (aqui a variável será dinâmica) -->
            <div class="mt-3">
                @isset($items)  <!-- Verifica se a variável está definida -->
                    {{ $items->links('pagination::bootstrap-5') }}
                @endisset
            </div>
        </div>
        

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function(){
            // Máscara para CNPJ
            $('#cnpj').mask('00.000.000/0000-00');
            // Máscara para CPF
            $('#cpf').mask('000.000.000-00');
            // Máscara para telefone
            $('#fone_contato').mask('(00) 00000-0000');
        });
    </script>
    
</body>
</html>
