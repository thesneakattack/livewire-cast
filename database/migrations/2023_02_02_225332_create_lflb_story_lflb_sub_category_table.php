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
        Schema::create('lflb_story_lflb_sub_category', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->integer('lflb_sub_category_id')->nullable()->index('FK_lflb_story_lflb_sub_category_lflb_sub_categories');
            $table->integer('lflb_story_id')->nullable()->index('FK_lflb_story_lflb_sub_category_lflb_stories');
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
        Schema::dropIfExists('lflb_story_lflb_sub_category');
    }
};
