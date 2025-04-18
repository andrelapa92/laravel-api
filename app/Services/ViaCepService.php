<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public function buscarEnderecoPorCep(string $cep): ?array
    {
        $cep = preg_replace('/[^0-9]/', '', $cep); // Limpa o CEP

        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->successful() && !$response->json('erro')) {
            return $response->json();
        }

        return null;
    }
}
