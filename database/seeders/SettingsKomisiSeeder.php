<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsKomisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "omzet_start" => 0,
                "operator" => "BETWEEN",
                "omzet_end" => 100000000,
                "komisi" => 0
            ],
            [
                "omzet_start" => 100000000,
                "operator" => "BETWEEN",
                "omzet_end" => 200000000,
                "komisi" => 2.5
            ],
            [
                "omzet_start" => 200000000,
                "operator" => "BETWEEN",
                "omzet_end" => 500000000,
                "komisi" => 5
            ],
            [
                "omzet_start" => 500000000,
                "operator" => ">=",
                "omzet_end" => null,
                "komisi" => 10
            ],
        ];
        DB::table("settings_komisi")->insert($data);
    }
}
