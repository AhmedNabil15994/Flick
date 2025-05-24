<?php

use Illuminate\Support\Facades\Schema;
use Modules\Influencer\Enum\GenderType;
use Illuminate\Database\Schema\Blueprint;
use Modules\Influencer\Enum\InfluencerType;
use Illuminate\Database\Migrations\Migration;

class CreateInfluencersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influencers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json("name");
            $table->json("bio")->nullable();
            $table->string('image')->default("/uploads/default.png")->nullable();
            $table->date("birth_date")->nullable();
            $table->string("gender", 10)->default(GenderType::MALE);
            $table->string("website_url")->nullable();
            $table->string('email')->nullable()->index();
            $table->boolean("status")->default(true)->index();
            $table->json("socials")->nullable();
            $table->foreignId("country_id")
                  ->nullable()
                  ->constrained("countries")
                  ->nullOnDelete()
                  ->cascadeOnUpdate();
            $table->string("type", 20)->default(InfluencerType::INSTAGRAM)->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('influencers');
    }
}
