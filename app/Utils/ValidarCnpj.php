<?php
namespace App\Utils;

class ValidarCnpj
{
    public function validate($attribute, $value, $parameters, $validator): bool
    {
        return $this->isValidate($attribute, $value);
    }

    protected function isValidate($attribute, $value): bool
    {
        $c = preg_replace('/\D/', '', $value);
        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        if (strlen($c) != 14) {
            return false;
        } elseif (preg_match("/^{$c[0]}{14}$/", $c) > 0) {
            return false;
        }
        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i])
            ;
        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++])
            ;
        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        return true;
    }
}
