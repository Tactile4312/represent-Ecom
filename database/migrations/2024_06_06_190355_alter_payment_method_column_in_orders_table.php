<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPaymentMethodColumnInOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method', 50)->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert the column to its previous state if necessary
            $table->string('payment_method')->change();
        });
    }
}
