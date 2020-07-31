<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = "slides";

    protected $fillable = ['ten', 'anh', 'link', 'trangthai'];

    public $timestamps = false;
}