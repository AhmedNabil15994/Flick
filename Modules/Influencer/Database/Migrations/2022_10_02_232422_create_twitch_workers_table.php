<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitchWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitch_workers', function (Blueprint $table) {
            $table->foreignId("twitch_id")
            ->constrained("twitches")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId("worker_id")
            ->constrained("users")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->primary(["twitch_id", "worker_id" ]);
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
        Schema::dropIfExists('twitch_workers');
    }
}
