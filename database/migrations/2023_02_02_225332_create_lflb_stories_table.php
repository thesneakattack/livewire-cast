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
        Schema::create('lflb_stories', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('_oldid', 50)->nullable();
            $table->string('title', 160);
            $table->integer('app_id')->nullable()->index('FK_lflb_stories_lflb_apps');
            $table->string('description', 16383)->nullable();
            $table->string('image', 120)->nullable();
            $table->string('imageUrl', 10)->nullable();
            $table->string('categories_old', 230)->nullable();
            $table->string('categories', 230)->nullable();
            $table->string('startDay', 10)->nullable();
            $table->string('startMonth', 10)->nullable();
            $table->string('startYear', 10)->nullable();
            $table->string('endDay', 10)->nullable();
            $table->string('endMonth', 10)->nullable();
            $table->string('endYear', 10)->nullable();
            $table->string('locationName', 90)->nullable();
            $table->string('location_lat', 10)->nullable();
            $table->string('location_lng', 10)->nullable();
            $table->string('metaData', 30)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lflb_stories');
    }
};
