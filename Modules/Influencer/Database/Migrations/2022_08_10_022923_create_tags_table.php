<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('title');
            $table->boolean('status')->default(true);
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('influencer_tag', function (Blueprint $table) {
            $table->foreignId("influencer_id")
                ->constrained("influencers")
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
            ;
            $table->foreignId("tag_id")
                ->constrained("tags")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->primary(["influencer_id", "tag_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('influencer_tags');
    }
}
