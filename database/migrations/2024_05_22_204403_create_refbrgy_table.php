<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefbrgyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refbrgy', function (Blueprint $table) {
            $table->id();
            $table->string('brgyCode')->nullable();
            $table->text('brgyDesc');
            $table->string('regCode')->nullable();
            $table->string('provCode')->nullable();
            $table->string('citymunCode')->nullable();
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
        Schema::dropIfExists('refbrgy');
    }
}
