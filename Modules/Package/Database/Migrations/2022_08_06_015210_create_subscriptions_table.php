<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id');
            $table->boolean("from_admin")->default(false);
            $table->boolean("is_default")->index()->default(false);
            $table->double("price")->default(0);
            $table->boolean("is_free")->default(false);
            $table->timestamp("start_at")->nullable();
            $table->timestamp("end_at")->nullable();
            // $table->foreignId("user_id")
            //       ->constrained("users")
            //       ->cascadeOnUpdate()
            //       ->cascadeOnDelete();
            //       ;
            $table->foreignId("package_id")
                  ->constrained("packages")
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            ;
            $table->uuid("transaction_id")->nullable();          
            $table->primary(["id"]);
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
        Schema::dropIfExists('subscriptions');
    }
}
