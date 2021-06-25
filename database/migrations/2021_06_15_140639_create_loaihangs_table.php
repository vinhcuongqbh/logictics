<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoaihangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loaihangs', function (Blueprint $table) {
            $table->id();
            $table->string('tenloaihang');
            $table->integer('khoiluongmin');
            $table->integer('khoiluongmax');
            $table->bigInteger('dongia');
            $table->text('ghichu');
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
        Schema::dropIfExists('loaihangs');
    }
}
