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
        Schema::create('lflb_assets', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('_oldid', 30)->nullable();
            $table->string('orgId', 30)->nullable();
            $table->string('link', 130)->nullable();
            $table->string('originalImage', 80)->nullable();
            $table->string('type', 10);
            $table->text('text')->default('');
            $table->text('cleanText')->default('');
            $table->string('name', 130)->nullable()->default('');
            $table->text('caption')->nullable()->default('');
            $table->string('tags', 50)->nullable();
            $table->string('thumbnail', 70)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lflb_assets');
    }
};
