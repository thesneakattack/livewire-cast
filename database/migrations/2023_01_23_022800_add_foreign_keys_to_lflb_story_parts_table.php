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
        Schema::table('lflb_story_parts', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'FK_lflb_story_parts_lflb_assets')->references(['id'])->on('lflb_assets')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['story_id'], 'FK_lflb_story_parts_lflb_stories')->references(['id'])->on('lflb_stories')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lflb_story_parts', function (Blueprint $table) {
            $table->dropForeign('FK_lflb_story_parts_lflb_assets');
            $table->dropForeign('FK_lflb_story_parts_lflb_stories');
        });
    }
};
