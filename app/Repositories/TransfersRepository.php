<?php

namespace App\Repositories;

use App\Models\Transfer;
use App\Queries\Transfers\RelatedTransfersQuery;
use DB;

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

    public function related_transfers(int $user_id): array
    {
        return DB::select(RelatedTransfersQuery::getQuery(), array($user_id, $user_id, $user_id, $user_id));
    }
}