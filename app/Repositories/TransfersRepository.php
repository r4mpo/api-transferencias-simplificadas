<?php

namespace App\Repositories;

use App\Models\Transfer;

class TransfersRepository
{
    public function register_db(array $data): Transfer
    {
        return Transfer::create($data);
    }
}