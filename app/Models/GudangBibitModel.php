<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#use Illuminate\Database\Eloquent\SoftDeletes;


class GudangBibitModel extends Model
{
    use HasFactory;
    #use SoftDeletes;

    protected $table  =  'gudang_bibit';
    protected $primaryKey   =  'id';
}
