<?php

namespace Tests\Feature;

use App\DTO\Default\ResponseDTO;
use App\Services\Auth\RegistrarService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected RegistrarService $registrarService;

    protected function setUp(): void
    {
        parent::setUp();
        // Mockando o serviço de registro
        $this->registrarService = $this->createMock(RegistrarService::class);
    }

    /** @test */
    public function test_registrar_usuario_com_sucesso()
    {
        $dados = [
            'name' => 'João Silva',
            'email' => 'joao.silva@example.com',
            'cpf' => '47531090031',
            'password' => 'senha123',
        ];

        $response = $this->postJson('/api/usuario/registrar', $dados);
        $this->assertEquals(111, $response->json('codigo_resposta'));
    }

    /** @test */
    public function test_registrar_usuario_com_falha_validacao(): void
    {
        $dados = [
            'name' => '',
            'email' => 'email-invalido',
            'cpf' => '47531090031',
            'password' => '123',
        ];

        $resposta_esperada = [
            0 => "O campo name é obrigatório.",
            1 => "O campo email deve ser um endereço de e-mail válido.",
            2 => "O campo password deve ter pelo menos 6 caracteres."
        ];

        $response = $this->postJson('/api/usuario/registrar', $dados);
        $this->assertEquals(333, $response->json('codigo_resposta'));
        $this->assertEquals($resposta_esperada, $response->json('resposta'));
    }
}