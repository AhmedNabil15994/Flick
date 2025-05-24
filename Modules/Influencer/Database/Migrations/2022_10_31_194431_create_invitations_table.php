<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Influencer\Enum\InvitationStatus;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('video')->nullable();
            $table->foreignId("campaign_id")
                ->constrained("campaigns")
                ->nullable()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId("event_id")
                    ->constrained("events")
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreignId("influencer_id")
                    ->constrained("influencers")
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->string("status", 20)->default(InvitationStatus::WAITING)->index()    ;
            $table->timestamp("approve_at")->nullable();
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
        Schema::dropIfExists('invitations');
    }
}
