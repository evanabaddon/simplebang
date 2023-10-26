<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CsrOutDonasiKreditModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table  =  "csr_out_donasi_kredit";
    protected $primaryKey   =  "id";
}
