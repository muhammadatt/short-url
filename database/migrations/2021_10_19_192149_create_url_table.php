<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url', function (Blueprint $table) {
            $table->id();
            //shortcode should be nullable because we'll need to save and generate an id before we generate the shortcode
            $table->string('shortcode', 50)->nullable();
            //the original url provided by user
            $table->text('original')->nullable();
            //flag to set whether the the link is Not Safe for Work
            $table->boolean('nsfw')->default(0);
            //counter for the number of times link has been clicked/viewed
            $table->unsignedInteger('view_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url');
    }
}
