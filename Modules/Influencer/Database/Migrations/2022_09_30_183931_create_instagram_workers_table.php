<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstagramWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_workers', function (Blueprint $table) {
            $table->foreignId("instagram_id")
            ->constrained("instagrams")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId("worker_id")
            ->constrained("users")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->primary(["instagram_id", "worker_id" ]);
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
        Schema::dropIfExists('instagram_workers');
    }
}
