<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CsrBibitModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table  =  'csr_bibit';
    protected $primaryKey    =   'id';
}
