<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_tags', function (Blueprint $table) {
            $table->foreignId("company_id")
            ->constrained("companies")
            ->cascadeOnUpdate()
            ->cascadeOnDelete()
            ;
            $table->foreignId("tag_id")
                ->constrained("tags")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->primary(["company_id", "tag_id"]);
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
        Schema::dropIfExists('company_tags');
    }
}
