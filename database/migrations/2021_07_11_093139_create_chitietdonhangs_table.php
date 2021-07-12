<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietdonhangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietdonhangs', function (Blueprint $table) {
            $table->foreignId('id_donhang');
            $table->foreignId('id_loaihang');
            $table->text('noidunghang');
            $table->integer('soluong')->nullable();
            $table->integer('khoiluong')->nullable();
            $table->integer('kichthuoc')->nullable();
            $table->bigInteger('giatriuoctinh')->nullable();
            $table->bigInteger('chiphi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietdonhangs');
    }
}
