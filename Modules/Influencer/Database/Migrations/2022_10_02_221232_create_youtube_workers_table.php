<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYoutubeWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_workers', function (Blueprint $table) {
            $table->foreignId("youtube_id")
            ->constrained("youtubes")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId("worker_id")
            ->constrained("users")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->primary(["youtube_id", "worker_id" ]);
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
        Schema::dropIfExists('youtube_workers');
    }
}
