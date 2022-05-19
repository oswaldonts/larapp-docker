<?php

namespace Database\Seeders;

use App\Models\AmmunitionType;
use Illuminate\Database\Seeder;
use File;

class AmmunitionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(public_path("data/ammunition_types.json"));
        $ammunition_types = json_decode($json);

        foreach ($ammunition_types as $ammunition_type) {
            AmmunitionType::create([
                "name" => $ammunition_type->name,
                "code" => $ammunition_type->code,
            ]);
        }
    }
}
