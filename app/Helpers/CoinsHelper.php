<?php

namespace App\Helpers;

class CoinsHelper
{
    public static function to_brazilian_coin_format(int $cents): string {
        $money = $cents / 100;
        return 'R$ ' . number_format($money, 2, ',', '.');
    }   
}