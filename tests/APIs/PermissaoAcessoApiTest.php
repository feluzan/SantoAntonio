<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PermissaoAcesso;

class PermissaoAcessoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_permissao_acesso()
    {
        $permissaoAcesso = factory(PermissaoAcesso::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/permissao_acessos', $permissaoAcesso
        );

        $this->assertApiResponse($permissaoAcesso);
    }

    /**
     * @test
     */
    public function test_read_permissao_acesso()
    {
        $permissaoAcesso = factory(PermissaoAcesso::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/permissao_acessos/'.$permissaoAcesso->id
        );

        $this->assertApiResponse($permissaoAcesso->toArray());
    }

    /**
     * @test
     */
    public function test_update_permissao_acesso()
    {
        $permissaoAcesso = factory(PermissaoAcesso::class)->create();
        $editedPermissaoAcesso = factory(PermissaoAcesso::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/permissao_acessos/'.$permissaoAcesso->id,
            $editedPermissaoAcesso
        );

        $this->assertApiResponse($editedPermissaoAcesso);
    }

    /**
     * @test
     */
    public function test_delete_permissao_acesso()
    {
        $permissaoAcesso = factory(PermissaoAcesso::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/permissao_acessos/'.$permissaoAcesso->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/permissao_acessos/'.$permissaoAcesso->id
        );

        $this->response->assertStatus(404);
    }
}
