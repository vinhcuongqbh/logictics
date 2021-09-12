<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChuyenhangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuyenhangs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('ngaygui')->nullable();
            $table->dateTime('ngaynhan')->nullable();
            $table->foreignId('id_khogui');
            $table->foreignId('id_khonhan');
            $table->integer('tongdonhang');
            $table->foreignId('id_nhanvienquanly');    
            $table->foreignId('id_trangthai');
            $table->text('ghichu')->nullable();
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
        Schema::dropIfExists('chuyenhangs');
    }
}
