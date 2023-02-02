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
        Schema::create('lflb_asset_lflb_story', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('_oldid', 30)->nullable();
            $table->integer('story_id')->nullable()->index('FK_lflb_story_parts_lflb_stories');
            $table->integer('asset_id')->nullable()->index('FK_lflb_story_parts_lflb_assets');
            $table->text('caption')->nullable();
            $table->tinyInteger('position')->nullable();
            $table->string('annotations', 80)->nullable();
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
        Schema::dropIfExists('lflb_asset_lflb_story');
    }
};
