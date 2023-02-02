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
        Schema::table('lflb_tags', function (Blueprint $table) {
            $table->foreign(['story_id'], 'FK_lflb_tags_lflb_stories')->references(['id'])->on('lflb_stories')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lflb_tags', function (Blueprint $table) {
            $table->dropForeign('FK_lflb_tags_lflb_stories');
        });
    }
};
