<?php

namespace App\Repositories;

use App\Models\User;
use App\Queries\Users\RegisterQuery;
use Illuminate\Support\Facades\DB;

class UsersRepository
{
    public function register_db(array $data): User
    {
        DB::insert(RegisterQuery::getQuery(), $data);
        return $this->get_last_result_db();
    }

    private function get_last_result_db(): User
    {
        $id = DB::getPdo()->lastInsertId();
        return $this->find_db($id);
    }

    private function find_db(int $id): User
    {
        return User::findOrFail($id);
    }
}