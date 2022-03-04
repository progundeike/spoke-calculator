<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpokeLengthListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoke_length_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('hubModel')->unique();
            $table->string('rimModel')->unique();
            $table->string('crossR');
            $table->string('crossL');
            $table->float('lengthR', 4, 1);
            $table->float('lengthL', 4, 1);
            $table->string('wheelMemo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spoke_length_lists');
    }
}
