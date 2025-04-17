<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ViaCepService;

class CepController extends Controller
{
    protected ViaCepService $viaCepService;

    public function __construct(ViaCepService $viaCepService)
    {
        $this->viaCepService = $viaCepService;
    }

    public function buscar(string $cep)
    {
        $data = $this->viaCepService->buscarEnderecoPorCep($cep);

        if (!$data) {
            return response()->json(['erro' => true], 404);
        }

        return response()->json($data);
    }
}
