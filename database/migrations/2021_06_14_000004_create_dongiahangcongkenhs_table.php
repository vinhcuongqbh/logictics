<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDongiahangcongkenhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dongiahangcongkenhs', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('dongiahangcongkenhs');
    }
}
