<?php

namespace App\Repositories;

use App\Models\User;
use App\Queries\Users\RegistrarQuery;
use Illuminate\Support\Facades\DB;

class UsersRepository
{
    public function registrar_db(array $dados): User
    {
        DB::insert(RegistrarQuery::getQuery(), $dados);
        return $this->obter_ultimo_resultado_db();
    }

    private function obter_ultimo_resultado_db(): User
    {
        $id = DB::getPdo()->lastInsertId();
        return $this->buscar_db($id);
    }

    private function buscar_db(int $id): User
    {
        return User::findOrFail($id);
    }
}