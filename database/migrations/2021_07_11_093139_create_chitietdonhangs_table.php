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
            $table->text('tenmathang');
            $table->integer('soluong')->nullable();
            $table->float('khoiluong')->nullable();
            $table->integer('kichthuoc')->nullable();
            $table->bigInteger('giatriuoctinh')->nullable();
            $table->bigInteger('chiphi');
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
        Schema::dropIfExists('chitietdonhangs');
    }
}
