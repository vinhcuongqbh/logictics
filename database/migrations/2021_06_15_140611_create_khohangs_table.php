<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhohangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khohangs', function (Blueprint $table) {
            $table->id();
            $table->string('tenkhohang');
            $table->string('sodienthoai')->nullable();
            $table->string('diachi')->nullable();
            $table->boolean('id_trangthai');
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
        Schema::dropIfExists('khohangs');
    }
}
