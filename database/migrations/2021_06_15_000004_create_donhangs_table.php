<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonhangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhangs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_nhanvienquanly');
            $table->foreignId('id_khogui')->nullable();
            $table->foreignId('id_khonhan')->nullable();
            $table->foreignId('id_chuyenhang')->nullable();
            $table->foreignId('id_trangthai');
            $table->string('tennguoigui');
            $table->string('sodienthoainguoigui');
            $table->string('diachinguoigui');
            $table->string('emailnguoigui')->nullable();
            $table->string('tennguoinhan');
            $table->string('sodienthoainguoinhan');
            $table->string('diachinguoinhan');
            $table->string('emailnguoinhan')->nullable();
            $table->bigInteger('tongchiphi');
            $table->bigInteger('chietkhau');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donhangs');
    }
}
