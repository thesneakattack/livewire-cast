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
        Schema::table('lflb_stories', function (Blueprint $table) {
            $table->foreign(['app_id'], 'FK_lflb_stories_lflb_apps')->references(['id'])->on('lflb_apps')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lflb_stories', function (Blueprint $table) {
            $table->dropForeign('FK_lflb_stories_lflb_apps');
        });
    }
};
