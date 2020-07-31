<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    protected $table = "sanpham";

    protected $fillable = ['id', 'sanpham_ten', 'sanpham_url', 'sanpham_anh', 'sanpham_mo_ta', 'loaisanpham_id', 'sanpham_khuyenmai', 'gia_ban', 'thong_so_ky_thuat'];

    public $timestamps = true;
}