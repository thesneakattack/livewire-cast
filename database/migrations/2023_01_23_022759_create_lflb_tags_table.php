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
        Schema::create('lflb_tags', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('_oldid', 30);
            $table->integer('story_id')->nullable()->index('FK_lflb_tags_lflb_stories');
            $table->string('storyid', 30)->nullable();
            $table->string('value', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lflb_tags');
    }
};
