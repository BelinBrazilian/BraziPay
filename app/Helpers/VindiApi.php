<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

final class VindiApi
{
    private static array $config;

    public static function config() : array
    {
        if (empty($config)) {
            self::set();
        }

        return self::$config;
    }

    private static function set(): void
    {
        self::$config = DB::query("SELECT api_key AS VINDI_API_KEY, api_uri AS VINDI_API_URI FROM vindi_config")->first();
    }
}