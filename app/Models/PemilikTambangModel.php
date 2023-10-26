<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemilikTambangModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table  =  "pemilik_tambang";
    protected $primaryKey   =  "id";
}
