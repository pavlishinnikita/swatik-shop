<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rate', function ($table) {
            $table->id();
            $table->string('base_currency_iso_code', 3)->default('');
            $table->string('exchange_currency_iso_code', 3)->default('');
            $table->decimal('exchange_rate')->unsigned()->default(0);
            $table->boolean('is_default')->default(0);
            $table->timestamps();
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_rate');
    }
};
