<?php

namespace App\Queries;

abstract class DefaultQuery
{
    public abstract static function getQuery(): string;
}