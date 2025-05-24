<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json("name")->nullable();
            $table->json("description")->nullable();
            $table->foreignId("manager_id")
                    ->constrained("users")
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            $table->string("logo")->default("/uploads/default.png")->nullable();
            $table->string("mobile")->nullable();
            $table->string("email")->nullable();
            $table->boolean("status")->index()->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('companies');
    }
}
