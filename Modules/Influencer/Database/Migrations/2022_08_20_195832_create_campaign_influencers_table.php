<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Influencer\Enum\CampaignInfluencerStatus;

class CreateCampaignInfluencersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_influencers', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignId("campaign_id")
                ->constrained("campaigns")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId("influencer_id")
                ->constrained("influencers")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string("status", 30)->default(CampaignInfluencerStatus::WAITING);
            $table->primary(["id"]);
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
        Schema::dropIfExists('campaign_influencers');
    }
}
