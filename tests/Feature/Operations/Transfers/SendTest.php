<?php

namespace Tests\Feature\Operations\Transfers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class SendTest extends TestCase
{
    use RefreshDatabase;

    protected string $token;
    protected User $payer;
    protected User $payee;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpUsers();
        $this->token = $this->authenticateUser(User::USER_PROFILE);
    }

    private function setUpUsers(): void
    {
        $this->payer = User::factory()->create([
            'profile' => User::USER_PROFILE,
            'balance' => 1000,
        ]);

        $this->payee = User::factory()->create([
            'profile' => User::STORE_OWNER_PROFILE,
            'balance' => 1000,
        ]);
    }

    private function authenticateUser(string $profile): string
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'profile' => $profile
        ]);

        $response = $this->postJson('/api/user/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        return $response->json('response')['token'];
    }

    public function testUserCanMakeATransferSuccessfully(): void
    {
        $response = $this->sendTransferRequest($this->payer->id, $this->payee->id, 100, $this->token);

        $response->assertStatus(201);
        $this->assertEquals(111, $response->json('response_code'));
    }

    public function testTransferFailsWithInsufficientBalance(): void
    {
        $this->payer->update(['balance' => 50]);

        $response = $this->sendTransferRequest($this->payer->id, $this->payee->id, 9999999999999999, $this->token);

        $response->assertStatus(404);
        $this->assertEquals(333, $response->json('response_code'));
    }

    public function testTransferFailsForUnauthorizedUser(): void
    {
        $token = $this->authenticateUser(User::STORE_OWNER_PROFILE);

        $response = $this->sendTransferRequest($this->payee->id, $this->payer->id, 100, $token);

        $response->assertStatus(404);
        $this->assertEquals(333, $response->json('response_code'));
    }

    private function sendTransferRequest(int $payerId, int $payeeId, float $value, string $token)
    {
        return $this->postJson('/api/transfer', [
            'payer' => $payerId,
            'payee' => $payeeId,
            'value' => $value,
        ], [
            'Authorization' => 'Bearer ' . $token
        ]);
    }
}