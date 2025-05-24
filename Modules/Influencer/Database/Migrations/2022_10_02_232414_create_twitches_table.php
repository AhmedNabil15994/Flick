<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("influencer_id")
                  ->constrained("influencers")
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->boolean("status")->default(true)->index();      
            $table->string("user_name")->nullable();
            $table->string("account_id")->nullable();
            $table->json("latest_calling")->nullable();
            $table->timestamp("latest_calling_at")->nullable();
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
        Schema::dropIfExists('twitches');
    }
}
