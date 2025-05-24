<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HandleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId("country_id")
                  ->nullable()
                  ->constrained("countries")
                  ->nullOnDelete()
                  ->cascadeOnUpdate();
            $table->string("company")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->dropForeign(["country_id"]);
           $table->dropColumn(["country_id"]);
        });
    }
}
