<?php

namespace Modules\Influencer\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Influencer\Entities\Tag;
use Illuminate\Database\Eloquent\Model;

class TagTableSeeder extends Seeder
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
        $this->insertData();
    }

    public function insertData()
    {
        $data = [
            [
                "title" => [
                    "ar" => "حياه",
                    "en" => "Life"
                ]
                ],
                [
                    "title" => [
                        "ar" => "طعام",
                        "en" => "Food"
                    ]
                ]
        ];

        foreach ($data as $object) {
            Tag::create($object);
        }
    }
}
