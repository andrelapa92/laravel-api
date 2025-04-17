<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <title>Editar Endereço</title>
</head>
<body>
    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4">Editar Endereço de {{ $user->name }}</h1>

        <!-- Exibir mensagens de sucesso ou erro -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Loader -->
        <div id="cep-loader" class="text-center my-3" style="display: none;">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Carregando...</span>
            </div>
            <p class="mt-2">Buscando endereço...</p>
        </div>

        <!-- Formulário -->
        <form action="{{ route('users.addresses.update', [$user->id, $address->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" name="cep" id="cep" class="form-control" maxlength="8" required value="{{ $address->cep }}" onblur="buscarEndereco()">
            </div>

            <div class="mb-3">
                <label for="street" class="form-label">Rua</label>
                <input type="text" name="street" id="street" class="form-control" required value="{{ $address->street }}">
            </div>

            <div class="mb-3">
                <label for="neighborhood" class="form-label">Bairro</label>
                <input type="text" name="neighborhood" id="neighborhood" class="form-control" required value="{{ $address->neighborhood }}">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Cidade</label>
                <input type="text" name="city" id="city" class="form-control" required value="{{ $address->city }}">
            </div>

            <div class="mb-3">
                <label for="state" class="form-label">Estado</label>
                <input type="text" name="state" id="state" class="form-control" required value="{{ $address->state }}">
            </div>

            <div class="mb-3">
                <label for="number" class="form-label">Número</label>
                <input type="text" name="number" id="number" class="form-control" required value="{{ $address->number }}">
            </div>

            <div class="mb-3">
                <label for="complement" class="form-label">Complemento</label>
                <input type="text" name="complement" id="complement" class="form-control" value="{{ $address->complement }}">
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center gap-2 mt-5">
                <span class="material-symbols-outlined">save</span>
                Atualizar Endereço
            </button>

            <a href="{{ route('users.addresses', $user->id) }}" class="btn btn-secondary w-100 mt-2 d-flex align-items-center justify-content-center gap-2">
                <span class="material-symbols-outlined">arrow_back</span>
                Voltar para Endereços
            </a>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
@vite(['resources/js/app.js'])
</body>
</html>
