<?php

namespace Database\Seeders;

use App\Models\ItemSubType;
use Illuminate\Database\Seeder;
use File;

class ItemSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(public_path("data/item_sub_types.json"));
        $item_sub_types = json_decode($json);

        foreach ($item_sub_types as $item_sub_type) {
            ItemSubType::create([
                "name" => $item_sub_type->name,
                "code" => $item_sub_type->code,
            ]);
        }
    }
}
