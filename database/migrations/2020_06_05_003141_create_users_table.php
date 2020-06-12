<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('income', 10, 2);
            $table->decimal('savings', 10, 2);
            $table->decimal('budget', 10, 2)->default(0.00);
            $table->decimal('balance', 10, 2)->default(0.00)->unsigned();
            $table->decimal('totalAmountSpent', 10, 2)->default(0.00);
            $table->decimal('totalPercentage', 5, 2)->default(0.00);
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
        Schema::dropIfExists('users');
    }
}
