<?php

namespace Modules\Influencer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Influencer\Database\Seeders\TagTableSeeder;
use Modules\Influencer\Database\Seeders\InfluencerInstagramTableSeeder;

class InfluencerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $this->call(TagTableSeeder::class);
        $this->call(InfluencerInstagramTableSeeder::class);
    }
}
