<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baiviet extends Model
{
    protected $table = 'baiviet';

	protected $fillable = ['baiviet_ten_gia','baiviet_tieu_de','baiviet_tom_tat','baiviet_noi_dung','baiviet_luot_xem','baiviet_anh'];

	public $timestamps = true;
}
