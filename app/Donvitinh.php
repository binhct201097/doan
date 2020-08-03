<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donvitinh extends Model
{
    protected $table = 'donvitinh';

    protected $fillable = ['donvitinh_ten', 'donvitinh_mo_ta', 'soluong'];

    public $timestamps = false;
}