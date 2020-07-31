<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lohang extends Model
{
    protected $table = "lohang";

    protected $fillable = ['id', 'lohang_gia_mua_vao', 'lohang_so_luong_sp', 'nhacungcap_id', 'sanpham_id'];

    public $timestamps = true;
}