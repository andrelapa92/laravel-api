<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            // Cada usuário vai ter de 1 a 3 endereços
            for ($i = 0; $i < rand(1, 3); $i++) {
                Address::create([
                    'user_id' => $user->id,
                    'cep' => $faker->postcode,
                    'street' => $faker->streetName,
                    'number' => $faker->buildingNumber,
                    'complement' => $faker->optional()->regexify('Apt\. \d{1,3}'),
                    'neighborhood' => $faker->randomElement([
                        'Centro', 'Campeche', 'Rio Tavares', 'Ribeirão da Ilha', 'Morro das Pedras', 'Itacorubi', 'Trindade', 'Córrego Grande', 'Estreito', 'Capoeiras', 'Saco dos Limões', 'Jardim Atlântico', 'Barra da Lagoa', 'Lagoa da Conceição', 'Praia Mole', 'Canasvieiras', 'Jurerê Internacional'
                    ]),
                    'city' => $faker->city,
                    'state' => $faker->stateAbbr,
                ]);
            }
        }
    }
}
