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
        Schema::table('lflb_asset_lflb_story', function (Blueprint $table) {
            $table->foreign(['story_id'], 'FK_lflb_asset_lflb_story_lflb_stories')->references(['id'])->on('lflb_stories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['asset_id'], 'FK_lflb_asset_lflb_story_lflb_assets')->references(['id'])->on('lflb_assets')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lflb_asset_lflb_story', function (Blueprint $table) {
            $table->dropForeign('FK_lflb_asset_lflb_story_lflb_stories');
            $table->dropForeign('FK_lflb_asset_lflb_story_lflb_assets');
        });
    }
};
