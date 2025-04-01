<?php

namespace Tests\Feature;

use App\DTO\Default\ResponseDTO;
use App\Services\Auth\RegisterService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected RegisterService $registerService;

    protected function setUp(): void
    {
        parent::setUp();
        // Mockando o serviço de registro
        $this->registerService = $this->createMock(RegisterService::class);
    }

    /** @test */
    public function test_register_user_com_sucesso()
    {
        $data = [
            'name' => 'João Silva',
            'email' => 'joao.silva@example.com',
            'individual_registration' => '47531090031',
            'password' => 'senha123',
        ];

        $response = $this->postJson('/api/user/register', $data);
        $this->assertEquals(111, $response->json('response_code'));
    }

    /** @test */
    public function test_register_user_com_falha_validacao(): void
    {
        $data = [
            'name' => '',
            'email' => 'email-invalido',
            'individual_registration' => '47531090031',
            'password' => '123',
        ];

        $response_esperada = [
            0 => "O campo name é obrigatório.",
            1 => "O campo email deve ser um endereço de e-mail válido.",
            2 => "O campo password deve ter pelo menos 6 caracteres."
        ];

        $response = $this->postJson('/api/user/register', $data);
        $this->assertEquals(333, $response->json('response_code'));
        $this->assertEquals($response_esperada, $response->json('response'));
    }
}