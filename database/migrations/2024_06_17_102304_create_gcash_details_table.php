<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGcashDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('gcash_details', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('qr_code_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gcash_details');
    }
}

