<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('hub_model')->unique();
            $table->bigInteger('hole');
            $table->float('centerFlangeRight', 4, 1);
            $table->float('centerFlangeLeft', 4, 1);
            $table->float('pcdRight', 4, 1);
            $table->float('pcdLeft', 4, 1);
            $table->string('hub_memo')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hubs');
    }
}
