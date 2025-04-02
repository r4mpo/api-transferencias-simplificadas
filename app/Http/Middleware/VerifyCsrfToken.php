<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Caso enfrente problemas com o VerifyCsrfToken, o qual é comumente utilizado em rotas web.php,
     * basta colocar $except = ['*'] na Middleware utilizada neste arquivo, em sua vendor local.
     *
     * @var array
     */
    protected $except = [
        '*'
    ];
}