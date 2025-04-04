<?php
namespace App\Queries\Transfers;

use App\Queries\DefaultQuery;

class RelatedTransfersQuery extends DefaultQuery
{
    public static function getQuery(): string
    {
        return "SELECT t.id, t.sender_id, sender.name AS sender_name, t.receiver_id, receiver.name AS receiver_name, t.value,
                    CASE WHEN t.status = 1 THEN 'Pending' WHEN t.status = 2 THEN 'Complete' WHEN t.status = 3 THEN 'Error' WHEN t.status = 4 THEN 'Notification error' ELSE 'Unknown' END AS status,
                    CASE WHEN t.sender_id = ? THEN 'Paid' WHEN t.receiver_id = ? THEN 'Received' ELSE 'Unknown' END AS type, t.created_at
                FROM transfers t
                JOIN users sender ON t.sender_id = sender.id
                JOIN users receiver ON t.receiver_id = receiver.id
                WHERE t.sender_id = ? OR t.receiver_id = ?
                ORDER BY t.created_at DESC";
    }
}