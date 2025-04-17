<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    // Métodos para API

    public function apiIndex()
    {
        return response()->json(User::all(), 200);
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json($user, 201);
    }

    public function apiShow(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        return response()->json($user, 200);
    }

    public function apiUpdate(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        $user->update([
            'name' => $validatedData['name'] ?? $user->name,
            'email' => $validatedData['email'] ?? $user->email,
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $user->password,
        ]);

        return response()->json(['message' => 'Usuário atualizado com sucesso.'], 200);
    }

    public function apiDestroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso.'], 200);
    }

    // Métodos para Front-End

    public function index()
    {
        $users = User::paginate(5); // 5 usuários por página
        return view('users.index', compact('users'));
    }

    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Usuário não encontrado.');
        }

        return view('users.showUser', compact('user'));
    }

    public function create()
    {
        return view('users.createUser');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // Confirmação de senha
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Usuário não encontrado.');
        }

        return view('users.editUser', compact('user')); // Passando o usuário para a view
    }


    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Usuário não encontrado.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso.');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Usuário não encontrado.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed', // Deixe a senha opcional
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

}
