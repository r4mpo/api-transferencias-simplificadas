<?php

namespace App\Repositories;

use App\Models\Transfer;

class TransfersRepository
{
    public function register_db(array $data): Transfer
    {
        return Transfer::create($data);
    }

    public function alter_db(Transfer $transfer, array $data): void
    {
        $transfer->update($data);
    }
}