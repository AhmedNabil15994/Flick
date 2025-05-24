<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Area\Entities\City;
use Modules\Area\Entities\Country;
use Illuminate\Database\Eloquent\Model;

class CitySeederTableSeeder extends Seeder
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
        $this->kwCity();
    }

    public function kwCity()
    {
        $cities = [
            [
                "title"=>[
                    "ar"=>"الفروانية",
                    "en"  => "Alfarwanya",
                     
                ],
                "slug"=>[
                    "ar"=>"Alfarwanya",
                    "en"  => "alfarwanya",
                ]
            ] ,
            [
                "title"=>[
                    "ar"=>"السالمية",
                    "en"  => "al-asimah",
                     
                ],
               "slug"=>[
                    "ar"=>"al-asimah",
                    "en"  => "al-asimah",
                ]
            ],
            [
                "title"=>[
                    "ar"=>"العاصمة",
                    "en"  => "al-asimah",
                     
                ],
                "slug"=>[
                    "ar"=>"العاصمة",
                    "en"  => "al-asimah",
                ]
            ],
            [
                "title"=>[
                    "ar"=>"الأحمدي",
                    "en"  => "Al-Ahmadi",
                     
                ],
                "slug"=>[
                    "ar"=>"الأحمدي",
                    "en"  => "al-ahmadi",
                ]
            ],
            [
                "title"=>[
                    "ar"=>"الجهراء",
                    "en"  => "Aljahra",
                     
                ],
               "slug"=>[
                    "ar"=>"الجهراء",
                    "en"  => "aljahra",
                ]
            ],
            [
                "title"=>[
                    "ar"=>"مبارك الكبير",
                    "en"  => "Mubarak akkabyr"
                     
                ],
               "slug"=>[
                    "ar"=>"مبارك-الكبير", 
                    "en"  => "mubarak-akkabyr",
                ]
            ],
            [
               "slug"=>[
                    "ar"=>"حولي",
                    "en"  => "7awaly",
                     
                ],
                "title"=>[
                    "ar"=>"حولي",
                    "en"  => "7awaly",
                ]
            ],
        ];
        foreach ($cities as $key => $city) {
           $data = array_merge($city, ["country_id"=>Country::first()->id]);
           City::create($data);
        }
    }
}
