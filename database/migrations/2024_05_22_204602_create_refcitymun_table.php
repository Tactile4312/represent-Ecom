<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefcitymunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refcitymun', function (Blueprint $table) {
            $table->id();
            $table->string('psgcCode')->nullable();
            $table->text('citymunDesc');
            $table->string('regDesc')->nullable();
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
        Schema::dropIfExists('refcitymun');
    }
}
