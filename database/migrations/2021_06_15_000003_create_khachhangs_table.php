<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhachhangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhangs', function (Blueprint $table) {
            $table->id();
            $table->string('tenkhachhang');
            $table->string('sodienthoai')/*->unique()*/;
            $table->string('diachi');
            $table->string('email')->nullable();
            $table->string('lienhekhac')->nullable();
            $table->foreignId('id_nhanvienquanly');
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
        Schema::dropIfExists('khachhangs');
    }
}
