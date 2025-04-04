<?php

namespace Tests\Feature\Operations;

use Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class OperationsTest extends TestCase
{
    // use RefreshDatabase;

    protected string $token;
    protected User $payer;
    protected User $payee;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpUsers();
        $this->token = $this->authenticateUser($this->payer);
    }

    private function setUpUsers(): void
    {
        $this->payer = User::factory()->create([
            'profile' => User::USER_PROFILE,
            'balance' => 1000,
            'password' => bcrypt('password'),
        ]);

        $this->payee = User::factory()->create([
            'profile' => User::STORE_OWNER_PROFILE,
            'balance' => 1000,
        ]);
    }

    private function authenticateUser($user = null, $profile = null): string
    {
        if ($user == null) {
            $user = User::factory()->create([
                'password' => bcrypt('password'),
                'profile' => $profile
            ]);
        }

        $response = $this->postJson('/api/user/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $token = $response->json('response')['token'];
        return $token;
    }

    public function testUserCanMakeATransferSuccessfully(): void
    {
        $response = $this->sendPostTransferRequest('/api/transfer', ['payee' => $this->payee->id, 'payer' => $this->payer->id, 'value' => 100], $this->token);
        $response->assertStatus(201);
        $this->assertEquals(111, $response->json('response_code'));
    }

    public function testFindStratunsUserAuthenticated(): void
    {
        $response = $this->sendGetTransferRequest('/api/stratuns', $this->token);
        // var_dump($response->json(), $this->token);exit;
        $response->assertStatus(200);
        $this->assertEquals(111, $response->json('response_code'));
    }

    public function testTransferFailsWithInsufficientBalance(): void
    {
        $this->payer->update(['balance' => 50]);

        $response = $this->sendPostTransferRequest('/api/transfer', ['payee' => $this->payee->id, 'payer' => $this->payer->id, 'value' => 999999999999999999], $this->token);

        $response->assertStatus(404);
        $this->assertEquals(333, $response->json('response_code'));
    }

    public function testTransferFailsForUnauthorizedUser(): void
    {
        $token = $this->authenticateUser(null, User::STORE_OWNER_PROFILE);

        $response = $this->sendPostTransferRequest('/api/transfer', ['payee' => $this->payee->id, 'payer' => $this->payer->id, 'value' => 100], $token);

        $response->assertStatus(404);
        $this->assertEquals(333, $response->json('response_code'));
    }
}