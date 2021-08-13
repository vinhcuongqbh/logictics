<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichsudonhangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichsudonhangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_donhang');
            $table->foreignId('id_nhanvienquanly');
            $table->foreignId('id_khogui');
            $table->foreignId('id_khonhan')->nullable();
            $table->foreignId('id_trangthai');
            $table->bigInteger('tongchiphi');
            $table->bigInteger('chietkhau');
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
        Schema::dropIfExists('lichsudonhangs');
    }
}
