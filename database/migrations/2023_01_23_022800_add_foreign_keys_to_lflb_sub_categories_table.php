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
        Schema::table('lflb_sub_categories', function (Blueprint $table) {
            $table->foreign(['category_id'], 'FK_lflb_sub_categories_lflb_categories')->references(['id'])->on('lflb_categories')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lflb_sub_categories', function (Blueprint $table) {
            $table->dropForeign('FK_lflb_sub_categories_lflb_categories');
        });
    }
};
