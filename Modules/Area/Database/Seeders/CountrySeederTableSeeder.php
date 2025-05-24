<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Area\Entities\Country;
use Illuminate\Database\Eloquent\Model;

class CountrySeederTableSeeder extends Seeder
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
        $this->createKw();
    }

    public function createKw(){
        Country::create([
            "title"=>[
                "ar"=>"الكويت",
                "en"  => "kuwait",
                 
            ],
            "nationality"=>[
                "ar"=>"الكويتى",
                "en"  => "kuwait",
            ],
            "slug"=>[
                "ar"=>"الكويت",
                "en"  => "kuwait",
            ]
        ]);
    }
}
