<?php

use App\Models\Good;
use App\Models\GoodCategory;
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
        Schema::create('good_category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('image')->default('');
            $table->tinyInteger('type')->unsigned()->default(GoodCategory::TYPE_SIMPLE);
            $table->timestamps();
        });

        Schema::create('good', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('good_category_id')->unsigned()->nullable();
            $table->string('name')->default('');
            $table->string('image')->default('');
            $table->tinyInteger('type')->unsigned()->default(Good::TYPE_DEFAULT);
            $table->decimal('price')->unsigned()->default(0);
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
        Schema::dropIfExists('good');
        Schema::dropIfExists('good_category');
    }
};
