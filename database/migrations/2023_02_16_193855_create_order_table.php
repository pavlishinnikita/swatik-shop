<?php

use App\Models\Order;
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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->unsigned()->default(Order::STATUS_OPEN);
            $table->string('invoice_id', 255)->default('');
            $table->json('details');
            $table->string('failure_reason', 1024)->default('');
            $table->timestamps();
        });

        Schema::create('order_good', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('good_id')->unsigned();
            $table->integer('count')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_good');
        Schema::dropIfExists('order');
    }
};
