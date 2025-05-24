<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiktokWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiktok_workers', function (Blueprint $table) {
            $table->foreignId("tiktok_id")
            ->constrained("tiktoks")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId("worker_id")
            ->constrained("users")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->primary(["tiktok_id", "worker_id" ]);
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
        Schema::dropIfExists('tiktok_workers');
    }
}
