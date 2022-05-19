<?php

namespace Database\Seeders;

use App\Models\ItemType;
use Illuminate\Database\Seeder;
use File;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(public_path("data/item_types.json"));
        $item_types = json_decode($json);

        foreach ($item_types as $item_type) {
            ItemType::create([
                "name" => $item_type->name,
                "code" => $item_type->code,
            ]);
        }
    }
}
