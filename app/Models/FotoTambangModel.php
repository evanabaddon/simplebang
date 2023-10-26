<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#use Illuminate\Database\Eloquent\SoftDeletes;

class FotoTambangModel extends Model
{
    use HasFactory;
  #  use SoftDeletes;

    protected $table  =  "foto_tambang";
    protected $primaryKey   =  "id";
}
