<?php

namespace Database\Seeders;

use App\Models\VindiConfig;
use Illuminate\Database\Seeder;

class VindiConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VindiConfig::create([
            'api_key' => env('VINDI_API_KEY'),
            'api_uri' => env('VINDI_API_URI'),
        ]);
    }
}
