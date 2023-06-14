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
        Schema::table('good', function ($table) {
            $table->boolean('need_human_action', 1)->default(0);
        });

        Schema::table('order_good', function ($table) {
            $table->decimal('price')->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('good', function ($table) {
            $table->dropColumn('need_human_action');
        });

        Schema::table('order_good', function ($table) {
            $table->dropColumn('price');
        });
    }
};
