<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_workers', function (Blueprint $table) {
            $table->foreignId("company_id")
            ->constrained("companies")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId("worker_id")
            ->constrained("users")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->primary(["company_id", "worker_id" ]);

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
        Schema::dropIfExists('company_workers');
    }
}
