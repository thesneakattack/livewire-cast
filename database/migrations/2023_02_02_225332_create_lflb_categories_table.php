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
        Schema::create('lflb_categories', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('_oldid', 30)->nullable();
            $table->string('title', 50);
            $table->string('description', 100)->nullable();
            $table->string('coverPhoto', 80)->nullable();
            $table->text('sub_categories_old')->nullable();
            $table->text('sub_categories')->nullable();
            $table->string('featured', 10)->default('FALSE');
            $table->text('introText')->nullable();
            $table->text('bodyText')->nullable();
            $table->string('mainImage', 80)->nullable();
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
        Schema::dropIfExists('lflb_categories');
    }
};
