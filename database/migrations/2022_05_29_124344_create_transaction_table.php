<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //no status field
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('product_type');
            $table->foreignId('user_id');
            $table->unsignedBigInteger('product_id');
            $table->jsonb('specs')->default('{}');
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
        Schema::dropIfExists('transactions');
    }
};
