<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\Influencer\Enum\CampaignStatus;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json("title");
            $table->json("description")->nullable();
            $table->date("start_at")->nullable();
            $table->string("cover")->default("/uploads/default.png");
            $table->boolean("is_active")->index()->default(true);
            $table->string("status", 30)->index()->default(CampaignStatus::WAITING);
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
        Schema::dropIfExists('campaigns');
    }
}
