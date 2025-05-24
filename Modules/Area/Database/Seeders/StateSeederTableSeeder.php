<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Area\Entities\City;
use Modules\Area\Entities\State;
use Illuminate\Database\Eloquent\Model;

class StateSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $this->SomeState();
    }

    public function SomeState()
    {
        $cities = [
            [
                "title"=>[
                    "ar"=>"السالمية",
                    "en"  => "Salmya",
                     
                ],
                "slug"=>[
                    "title"=>"السالمية",
                    "slug"  => "salmya",
                ]
            ] ,
           
        ];
        foreach ($cities as $key => $city) {
           $data = array_merge($city, ["city_id"=>City::first()->id]);
           State::create($data);
        }
    }
}
