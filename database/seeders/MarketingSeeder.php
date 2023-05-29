<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "id" => 1,
                "name" => "Alfandy"
            ],
            [
                "id" => 2,
                "name" => "Mery"
            ],
            [
                "id" => 3,
                "name" => "Danang"
            ],
        ];
        DB::table("marketing")->insert($data);
    }
}
