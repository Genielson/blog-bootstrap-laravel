<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmphasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emphasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("post_id");
            $table->timestamps();
        });

        Schema::table('emphasis', function(Blueprint $table){
           $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');;
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emphasis');
    }
}
