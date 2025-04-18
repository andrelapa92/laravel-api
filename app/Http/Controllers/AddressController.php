<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ViaCepService;

class AddressController extends Controller
{
    protected ViaCepService $viaCepService;

    public function __construct(ViaCepService $viaCepService)
    {
        $this->viaCepService = $viaCepService;
    }

    // Criar um endereço via CEP (API)
    public function apiStore(Request $request)
    {
        $request->validate([
            'cep' => 'required|string|size:8',
            'user_id' => 'required|exists:users,id',
        ]);

        $data = $this->viaCepService->buscarEnderecoPorCep($request->cep);

        if (!$data) {
            return response()->json(['message' => 'CEP inválido ou não encontrado.'], 404);
        }

        $address = Address::create([
            'user_id' => $request->user_id,
            'cep' => $request->cep,
            'street' => $data['logradouro'],
            'neighborhood' => $data['bairro'],
            'city' => $data['localidade'],
            'state' => $data['uf'],
            'number' => $request->number,
            'complement' => $request->complement,
        ]);

        return response()->json($address, 201);
    }

    public function apiIndex()
    {
        return response()->json(Address::all(), 200);
    }

    public function apiShow(string $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Endereço não encontrado.'], 404);
        }

        return response()->json($address);
    }

    public function apiDestroy(string $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Endereço não encontrado.'], 404);
        }

        $address->delete();

        return response()->json(['message' => 'Endereço excluído com sucesso.'], 200);
    }

    // Métodos para Front-End

    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $addresses = $user->addresses()->paginate(5);

        return view('addresses.index', compact('user', 'addresses'));
    }

    public function create($userId)
    {
        $user = User::findOrFail($userId);

        return view('addresses.createAddress', compact('user'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate([
            'cep' => 'required|string|size:8',
            'street' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'number' => 'nullable|string',
            'complement' => 'nullable|string',
        ]);

        Address::create([
            'user_id' => $userId,
            'cep' => $request->cep,
            'street' => $request->street,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'number' => $request->number,
            'complement' => $request->complement,
        ]);

        return redirect()->route('users.addresses', $userId)
            ->with('success', 'Endereço criado com sucesso.');
    }

    public function edit($userId, $addressId)
    {
        $user = User::findOrFail($userId);
        $address = Address::where('user_id', $userId)->findOrFail($addressId);

        return view('addresses.editAddress', compact('user', 'address'));
    }

    public function update(Request $request, $userId, $addressId)
    {
        $request->validate([
            'cep' => 'required|string|size:8',
            'street' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'number' => 'nullable|string',
            'complement' => 'nullable|string',
        ]);

        $address = Address::where('user_id', $userId)->findOrFail($addressId);

        $address->update([
            'cep' => $request->cep,
            'street' => $request->street,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'number' => $request->number,
            'complement' => $request->complement,
        ]);

        return redirect()->route('users.addresses', $userId)->with('success', 'Endereço atualizado com sucesso.');
    }

    public function destroy($userId, $addressId)
    {
        $address = Address::where('user_id', $userId)->findOrFail($addressId);
        $address->delete();

        return redirect()->route('users.addresses', $userId)->with('success', 'Endereço excluído com sucesso.');
    }
}
