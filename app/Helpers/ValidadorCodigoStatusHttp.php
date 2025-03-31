<?php

namespace App\Helpers;

class ValidadorCodigoStatusHttp
{
    public static function e_codigo_status_http_valido(int $codigo): int
    {
        $codigos_status_validos = [
            100, 101, 102, 103, 200, 201, 202, 203, 204, 205, 206, 207, 208, 226,
            300, 301, 302, 303, 304, 305, 307, 308, 400, 401, 402, 403, 404, 405,
            406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 419,
            420, 421, 422, 423, 424, 426, 428, 429, 431, 451, 500, 501, 502, 503,
            504, 505, 506, 507, 508, 510, 511
        ];

        if (in_array($codigo, $codigos_status_validos)) {
            return $codigo;
        } else {
            return 500;
        }
    }
}