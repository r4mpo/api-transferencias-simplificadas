<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function sendPostTransferRequest($url, $data = array(), $token)
    {
        return $this->postJson($url, $data, [
            'Authorization' => 'Bearer ' . $token
        ]);
    }

    protected function sendGetTransferRequest($url, $token)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, 
            'Accept' => 'application/json'
        ])->getJson($url);
    }
}