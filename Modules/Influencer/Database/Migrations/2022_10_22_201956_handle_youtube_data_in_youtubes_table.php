<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HandleYoutubeDataInYoutubesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('youtubes', function (Blueprint $table) {
            $table->string("url")->nullable();
            $table->boolean("is_verified")->default(false);
            $table->boolean("is_hidden")->default(false);
            $table->unsignedBigInteger("followers")->nullable()->default("0");
            $table->unsignedBigInteger("engagements")->nullable()->default("0");

            $table->unsignedBigInteger("posts_count")->nullable()->default("0");
            $table->unsignedBigInteger("avg_likes")->nullable()->default("0");
            $table->unsignedBigInteger("avg_views")->nullable()->default("0");
            $table->unsignedBigInteger("avg_dislikes")->nullable()->default("0");
            $table->unsignedBigInteger("avg_comments")->nullable()->default("0");
            $table->unsignedBigInteger("total_views")->nullable()->default("0");
            $table->json("stat_history")->nullable();
            $table->json("audience_genders")->nullable();
            $table->json("audience_genders_commenter")->nullable();
            $table->json("audience_genders_per_age_commenter")->nullable();
            $table->json("audience_ages")->nullable();
            $table->json("audience_genders_per_age")->nullable();
            $table->json("api_info")->nullable();

            $table->double("engagement_rate")->nullable()->default("0");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
