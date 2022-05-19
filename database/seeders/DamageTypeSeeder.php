<?php

namespace Database\Seeders;

use App\Models\DamageType;
use Illuminate\Database\Seeder;
use File;

class DamageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(public_path("data/damage_types.json"));
        $damage_types = json_decode($json);

        foreach ($damage_types as $damage_type) {
            DamageType::create([
                "name" => $damage_type->name,
                "code" => $damage_type->code,
            ]);
        }
    }
}
