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
        Schema::create('lflb_apps', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('_oldid', 30)->nullable();
            $table->string('name', 80);
            $table->string('orgId', 30)->nullable();
            $table->text('description')->nullable();
            $table->string('image', 80)->nullable();
            $table->text('categories')->nullable();
            $table->text('categories_old')->nullable();
            $table->string('mapCenterAddress', 60)->nullable();
            $table->string('mapCenterAddressCoords_lat', 20)->nullable();
            $table->string('mapCenterAddressCoords_lng', 20)->nullable();
            $table->string('mainColor', 10)->nullable();
            $table->string('secondaryColor', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lflb_apps');
    }
};
