<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileColumToInfluencersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('influencers', function (Blueprint $table) {
            $table->string("phone_code", 8)->default("965");
            $table->string("mobile", 40)->default("");
            $table->index(["phone_code","mobile"]);
            
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
            $table->dropIndex(["phone_code","mobile"]);
            $table->dropColumn(["phone_code","mobile"]);
        });
    }
}
