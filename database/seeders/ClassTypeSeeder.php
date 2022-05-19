<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Seeder;
use File;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(public_path("data/class_types.json"));
        $class_types = json_decode($json);

        foreach ($class_types as $class_type) {
            ClassType::create([
                "name" => $class_type->name,
                "code" => $class_type->code,
            ]);
        }
    }
}
