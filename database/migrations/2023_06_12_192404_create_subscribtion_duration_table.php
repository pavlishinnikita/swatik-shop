<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('subscription_duration', function (Blueprint $table) {
            $table->id();
            $table->text('value');
            $table->text('label');
        });

        Schema::create('entity_subscription', function (Blueprint $table) {
            $table->bigInteger('entity_id');
            $table->bigInteger('subscription_duration_id');
            $table->enum('entity_type', ['good', 'category']);
            $table->decimal('price')->default(0.0);

            $table->unique(['entity_id', 'subscription_duration_id', 'entity_type'], 'entity_subscription_duration_idx');
        });
        DB::table('subscription_duration')->insert([
            [
                'value' => '30d',
                'label' => '30 Д',
            ],
            [
                'value' => '90d',
                'label' => '90 Д',
            ],
            [
                'value' => 'unlimit',
                'label' => '∞',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_duration');
        Schema::dropIfExists('entity_subscription');
    }
};
