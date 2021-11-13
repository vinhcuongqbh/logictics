<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDongiatinhtheosoluongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dongiatinhtheosoluongs', function (Blueprint $table) {
            $table->id();
            $table->string('tenmathang');
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
        Schema::dropIfExists('dongiatinhtheosoluongs');
    }
}
