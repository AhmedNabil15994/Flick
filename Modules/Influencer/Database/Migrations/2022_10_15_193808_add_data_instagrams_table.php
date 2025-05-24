<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataInstagramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instagrams', function (Blueprint $table) {
            $table->string("url")->nullable();
            $table->boolean("is_verified")->default(false);
            $table->boolean("is_business")->default(false);
            $table->boolean("is_hidden")->default(false);
            $table->unsignedBigInteger("followers")->nullable()->default("0");
            $table->unsignedBigInteger("engagements")->nullable()->default("0");
            $table->unsignedBigInteger("posts_count")->nullable()->default("0");
            $table->unsignedBigInteger("avg_comments")->nullable()->default("0");
            $table->unsignedBigInteger("avg_views")->nullable()->default("0");
            $table->unsignedBigInteger("avg_reels_plays")->nullable()->default("0");
            $table->unsignedBigInteger("posts_with_hidden_likes_percentage")->nullable()->default("0");
            $table->json("stat_history")->nullable();
            $table->json("audience_genders")->nullable();
            $table->json("audience_types")->nullable();

            $table->json("audience_ages")->nullable();
            $table->json("audience_genders_per_age")->nullable();
            $table->unsignedTinyInteger("account_type")->nullable();
            $table->json("api_info")->nullable();



            $table->double("engagement_rate")->nullable()->default("0");
            $table->double("audience_credibility")->nullable()->default("0");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instagrams', function (Blueprint $table) {
        });
    }
}
