<?php
namespace App\Queries\Users;

use App\Queries\DefaultQuery;

class RegisterQuery extends DefaultQuery
{
    public static function getQuery(): string
    {
        return "INSERT INTO users (name, email, individual_registration, legal_entity_number_registration, profile, password, email_verified_at, remember_token, created_at, updated_at) 
            VALUES (:name, :email, :individual_registration, :legal_entity_number_registration, :profile, :password, :email_verified_at, :remember_token, :created_at, :updated_at);"; 
    }
}