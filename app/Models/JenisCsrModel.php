<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCsrModel extends Model
{
    use HasFactory;
    protected $table  =  'jenis_csr';
    protected $primaryKey   =  'id';
}
