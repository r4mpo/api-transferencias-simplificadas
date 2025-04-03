<?php

namespace Tests\Feature\Operations\Transfers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Transfer;
use Laravel\Sanctum\Sanctum;

class SendTest extends TestCase
{
    use RefreshDatabase;

    protected string $token;
    protected User $payer;
    protected User $payee;

    protected function setUp(): void
    {
        parent::setUp();

        $this->payer = User::factory()->create([
            'profile' => User::USER_PROFILE,
            'balance' => 1000,
        ]);

        $this->payee = User::factory()->create([
            'profile' => User::STORE_OWNER_PROFILE,
            'balance' => 1000,
        ]);

        $this->token = $this->authenticateUser($this->payer);
    }

    public function authenticateUser(): string
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);
    
        $response = $this->postJson('/api/user/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
    
        dd($response->json()); // Adicionado para depuração
    
        return $response->json('token');
    }
    
    public function testUserCanMakeATransferSuccessfully()
    {
        $response = $this->postJson('/api/transfer', [
            'payer' => $this->payer->id,
            'payee' => $this->payee->id,
            'value' => 100,
        ], [
            'Authorization' => 'Bearer ' . $this->token
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'response' => [
                'value', 'sender', 'receiver'
            ],
            'response_code'
        ]);
    }

    public function testTransferFailsWithInsufficientBalance()
    {
        $this->payer->update(['balance' => 50]);

        $response = $this->postJson('/api/transfer', [
            'payer' => $this->payer->id,
            'payee' => $this->payee->id,
            'value' => 100,
        ], [
            'Authorization' => 'Bearer ' . $this->token
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'response' => 'Saldo insuficiente para realizar a transferência.',
            'response_code' => 333,
        ]);
    }

    public function testTransferFailsForUnauthorizedUser()
    {
        $unauthorizedUser = User::factory()->create([
            'profile' => 'lojista',
        ]);

        $token = $this->authenticateUser($unauthorizedUser);

        $response = $this->postJson('/api/transfer', [
            'payer' => $unauthorizedUser->id,
            'payee' => $this->payee->id,
            'value' => 100,
        ], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'response' => 'Apenas usuários com o respectivo perfil podem executar transferências.',
            'response_code' => 333,
        ]);
    }
}