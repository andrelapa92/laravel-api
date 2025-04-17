<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Usuários</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4 text-center">Lista de Usuários</h1>

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
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <a href="{{ url('users/' . $user->id . '/edit') }}"
                    class="btn btn-warning d-flex align-items-center justify-content-center"
                    title="Editar">
                        <span class="material-symbols-outlined">edit</span>
                    </a>

                    <!-- Botão que abre o modal -->
                    <button type="button"
                            class="btn btn-danger d-flex align-items-center justify-content-center"
                            title="Deletar"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteUserModal{{ $user->id }}">
                        <span class="material-symbols-outlined">delete</span>
                    </button>

                    <a href="{{ url('users/' . $user->id . '/addresses') }}"
                    class="btn btn-primary d-flex align-items-center justify-content-center"
                    title="Endereços">
                        <span class="material-symbols-outlined">home</span>
                    </a>
                </div>
            </td>
        </tr>

        <!-- Modal de Confirmação -->
        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">Confirmar Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir o usuário <strong>{{ $user->name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                        <!-- Formulário de exclusão -->
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Sim, excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        </tbody>
        </table>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center gap-2 mb-5">
            <span class="material-symbols-outlined">person_add</span> Adicionar Usuário
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
</body>
</html>
