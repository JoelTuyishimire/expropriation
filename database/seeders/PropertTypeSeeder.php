<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types =
            [
                ["id"=>1, "name"=>"Inzu", "name_en"=>"House"],
                ["id"=>2, "name"=>"Ubutaka", "name_en"=>"Land"],
                ["id"=>3, "name"=>"Ishyamba", "name_en"=>"Forest"],
        ];
        foreach ($types as $type)
        {
            PropertyType::create($type);
        }
    }
}
