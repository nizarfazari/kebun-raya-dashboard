<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_buyers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id')->unsigned();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email");
            $table->string("city");
            $table->string("province");
            $table->string("courier");
            $table->string("cost_courier");
            $table->string("estimasi");
            $table->foreign('transaction_id')->references('id')->on("transactions")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_buyers');
    }
};
