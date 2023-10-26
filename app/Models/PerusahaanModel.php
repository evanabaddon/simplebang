<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#use Illuminate\Database\Eloquent\SoftDeletes;

class PerusahaanModel extends Model
{
    use HasFactory;
    #use SoftDeletes;

    protected $table =   "perusahaan";
    protected $primaryKey   =  "id";
}
