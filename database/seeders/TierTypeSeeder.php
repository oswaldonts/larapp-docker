<?php

namespace Database\Seeders;

use App\Models\TierType;
use Illuminate\Database\Seeder;
use File;

class TierTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(public_path("data/tier_types.json"));
        $tier_types = json_decode($json);

        foreach ($tier_types as $tier_type) {
            TierType::create([
                "name" => $tier_type->name,
                "code" => $tier_type->code,
            ]);
        }
    }
}
