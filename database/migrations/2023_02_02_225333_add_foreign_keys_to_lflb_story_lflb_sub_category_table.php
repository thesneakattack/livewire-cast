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
        Schema::table('lflb_story_lflb_sub_category', function (Blueprint $table) {
            $table->foreign(['lflb_sub_category_id'], 'FK_lflb_story_lflb_sub_category_lflb_sub_categories')->references(['id'])->on('lflb_sub_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['lflb_story_id'], 'FK_lflb_story_lflb_sub_category_lflb_stories')->references(['id'])->on('lflb_stories')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lflb_story_lflb_sub_category', function (Blueprint $table) {
            $table->dropForeign('FK_lflb_story_lflb_sub_category_lflb_sub_categories');
            $table->dropForeign('FK_lflb_story_lflb_sub_category_lflb_stories');
        });
    }
};
