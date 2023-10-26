<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'users/data',
        'tambang/data',
        'jenis-tambang/data',
        'jenis-usaha/data',
        'perusahaan/data',
        'bibit/data',
        'gudang-bibit/data'
    ];
}
