<?php

namespace Modules\Influencer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Influencer\Entities\Influencer;
use Modules\Influencer\Enum\InfluencerType;

class InfluencerInstagramTableSeeder extends Seeder
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
        $this->insert();
    }

    public function insert(){
        $data = [
            [
                "name" => [
                    "ar" => "test" ,
                    "en" => "test",
                ],
                "bio" => [
                    "ar" => "test" ,
                    "en" => "test",
                ],
                "email"=>"instagram@gmail.com",
                "contact_number"=> "+96523565",
                "socials"=> ["facebook"=>"http://www.facebook.com"],

            ]
        ];

        foreach ($data as $object) {
            $object["type"] = InfluencerType::INSTAGRAM;
            Influencer::create($object);
        }
    }
}
