<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LienHe extends Model
{
    protected $table = "lienhe";

    protected $fillable = ['id', 'ten', 'email', 'chu_de', 'noidung'];

    public $timestamps = true;
}