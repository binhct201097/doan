<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNguyenlieuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguyenlieu', function (Blueprint $table) {
            $table->integer('baiviet_id')->unsigned();
            $table->foreign('baiviet_id')->references('id')->on('baiviet')->onUpdate('cascade');
            $table->integer('sanpham_id')->unsigned();
            $table->foreign('sanpham_id')->references('id')->on('sanpham')->onUpdate('cascade');
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
        Schema::dropIfExists('nguyenlieu');
    }
}
