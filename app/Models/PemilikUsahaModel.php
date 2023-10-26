<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemilikUsahaModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table  =  "pemilik_usaha";
    protected $primaryKey   =  "id";
}
