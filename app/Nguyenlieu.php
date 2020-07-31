<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nguyenlieu extends Model
{
    protected $table = 'nguyenlieu';

	protected $fillable = ['sanpham_id','baiviet_id'];

	public $timestamps = false;
}
