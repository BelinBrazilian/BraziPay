<?php

namespace App\Helpers;

use App\Models\VindiConfig;
use Illuminate\Support\Facades\DB;

final class VindiApi
{
    private static ?array $config;

    public static function config(): array
    {
        self::$config = [
            'VINDI_API_KEY' => '09d5400feb00aff',
            'VINDI_API_URI' => 'https://sandbox-app.vindi.com.br/api/v1',
        ];

        if (empty(self::$config)) {
            self::set();
        }

        return self::$config;
    }

    private static function set(): void
    {
        //        self::$config = DB::query('SELECT api_key AS VINDI_API_KEY, api_uri AS VINDI_API_URI FROM vindi_config')->first();
        self::$config = VindiConfig::select([
            'api_key as VINDI_API_KEY',
            'api_uri as VINDI_API_URI'
        ])->first()->toArray();
    }
}
