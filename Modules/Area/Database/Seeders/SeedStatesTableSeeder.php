<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use IlluminateAgnostic\Str\Support\Str;

class SeedStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($state, $city)
    {
        $city->states()->updateOrCreate(["title->en"=>$state["en"]],
         [
            "title"=>$state ,
            "slug" =>['ar' =>  slugfy($state['ar']),'en' => Str::slug($state['en'])]
            ]
        );
    }
}
