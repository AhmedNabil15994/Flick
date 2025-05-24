<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HandleInfluencersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('influencers', function (Blueprint $table) {
            $table->foreignId("nationality_id")
            ->nullable()
            ->constrained("countries")
            ->nullOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId("city_id")
            ->nullable()
            ->constrained("cities")
            ->nullOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId("state_id")
            ->nullable()
            ->constrained("states")
            ->nullOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('influencers', function (Blueprint $table) {
            $table->dropForeign(["nationality_id", "city_id", "state_id"]);

            $table->dropColumn(["nationality_id", "city_id", "state_id", "gender", "birth_date"]);
        });
    }
}
