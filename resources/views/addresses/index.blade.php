<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endereços de {{ $user->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body>
    <div class="container mb-5">
        <h1 class="my-4 text-center">Endereços de {{ $user->name }}</h1>

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

        <table id="userTable" class="table table-bordered text-center align-middle mb-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CEP</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Número</th>
                    <th>Complemento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->addresses as $address)
                    <tr>
                        <td>{{ $address->id }}</td>
                        <td>{{ $address->cep }}</td>
                        <td>{{ $address->street }}</td>
                        <td>{{ $address->neighborhood }}</td>
                        <td>{{ $address->city }}</td>
                        <td>{{ $address->state }}</td>
                        <td>{{ $address->number }}</td>
                        <td>{{ $address->complement }}</td>
                        <td class="d-flex justify-content-center align-items-center gap-2">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('users.addresses.edit', [$user->id, $address->id]) }}" class="btn btn-warning d-flex align-items-center justify-content-center">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                
                                <!-- Botão que abre o modal -->
                                <button type="button"
                                        class="btn btn-danger d-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteAddressModal{{ $address->id }}">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>

                                <!-- Modal de confirmação -->
                                <div class="modal fade" id="deleteAddressModal{{ $address->id }}" tabindex="-1" aria-labelledby="deleteAddressModalLabel{{ $address->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteAddressModalLabel{{ $address->id }}">Confirmar Exclusão</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir o endereço <strong>{{ $address->street }}, {{ $address->number }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('users.addresses.destroy', [$user->id, $address->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Sim, excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($addresses->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                Nenhum endereço encontrado para este usuário.
            </div>
        @endif
        @if ($addresses->count() > 0)
            <div class="alert alert-info text-center" role="alert">
                Total de endereços: {{ $addresses->total() }}
            </div>
        @endif

        <!-- Paginação -->
        <div class="d-flex justify-content-center">
            {{ $addresses->links() }}
        </div>

        <a href="{{ route('users.addresses.create', $user->id) }}" class="btn btn-success btn-lg w-100 mt-4 d-flex align-items-center justify-content-center gap-2">
            <span class="material-symbols-outlined">add_home</span>
            Adicionar Endereço
        </a>

        <a href="{{ route('users.index') }}" class="btn btn-secondary w-100 mt-2 d-flex align-items-center justify-content-center gap-2">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar para Usuários
        </a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
