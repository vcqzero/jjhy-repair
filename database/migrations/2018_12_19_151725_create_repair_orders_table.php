<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order');
            $table->integer('created_by');
            $table->integer('workyard_id');
            $table->integer('repair_type_id');
            $table->string('desc');
            $table->string('contact_user');
            $table->string('contact_tel');
            $table->string('grade');
            $table->decimal('budget');
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
        Schema::dropIfExists('repair_orders');
    }
}
