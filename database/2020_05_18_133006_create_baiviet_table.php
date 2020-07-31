<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaivietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baiviet', function (Blueprint $table) {
            $table->increments('id');
            $table->string('baiviet_tieu_de');
            $table->string('baiviet_url');
            $table->longText('baiviet_tom_tat');
            $table->longText('baiviet_noi_dung');
            $table->integer('baiviet_luot_xem');
            $table->string('baiviet_anh');
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
        Schema::dropIfExists('baiviet');
    }
}
