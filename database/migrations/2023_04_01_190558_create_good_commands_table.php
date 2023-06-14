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
        Schema::create('good_command', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('good_id')->unsigned()->default(0);
            $table->string('command', 1024)->default('');
            $table->timestamps();

            $table->index(['good_id'], 'command_good_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_command');
    }
};
