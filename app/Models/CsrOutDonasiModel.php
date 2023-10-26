<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CsrOutDonasiModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table  =  'csr_out_donasi';
    protected $primaryKey   =  'id';
}
