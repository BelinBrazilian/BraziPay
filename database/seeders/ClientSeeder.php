<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\TenancyUser;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $tenant = Tenant::all()->first() ?? false;

        if (! $tenant) {
            $uuid = Str::uuid()->toString();

            $client = Client::create([
                'id' => $uuid,
                'name' => 'Cliente Exemplo',
                'cpf_cnpj' => '12345678901',
                'address' => 'Endereço Exemplo',
                'email' => 'cliente@example.com',
                'phone' => '1234567890',
                'social_networks' => ['facebook' => 'facebook.com/cliente'],
            ]);

            $tenant = Tenant::create([
                'id' => $uuid,
                'name' => 'Cliente Exemplo', // Adicionando o campo 'name'
                'plan' => 'free',
                'data' => [
                    'name' => 'Cliente Exemplo',
                    'domain' => $uuid . '.example.com',
                    'plan' => 'free',
                ],
            ]);

            $tenant->domains()->create(['domain' => $uuid . '.example.com']);
        }

        $uuid = $tenant->id ?? $uuid;        

        dd($tenant->domains());

        TenancyUser::create([
            'tenant_id' => $uuid,
            'name' => 'Admin Exemplo',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Criar o banco de dados do tenant
        tenancy()->initialize($tenant);
        $tenant->run(function () {
            Artisan::call('tenants:migrate');
        });
    }
}
