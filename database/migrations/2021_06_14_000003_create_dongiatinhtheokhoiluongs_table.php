<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDongiatinhtheokhoiluongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dongiatinhtheokhoiluongs', function (Blueprint $table) {
            $table->id();
            $table->integer('khoiluongmax');
            $table->bigInteger('dongiaduongbien');
            $table->bigInteger('dongiaduongkhong');
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
        Schema::dropIfExists('dongiatinhtheokhoiluongs');
    }
}
