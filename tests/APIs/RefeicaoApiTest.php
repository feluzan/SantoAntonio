<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Refeicao;

class RefeicaoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_refeicao()
    {
        $refeicao = factory(Refeicao::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/refeicaos', $refeicao
        );

        $this->assertApiResponse($refeicao);
    }

    /**
     * @test
     */
    public function test_read_refeicao()
    {
        $refeicao = factory(Refeicao::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/refeicaos/'.$refeicao->id
        );

        $this->assertApiResponse($refeicao->toArray());
    }

    /**
     * @test
     */
    public function test_update_refeicao()
    {
        $refeicao = factory(Refeicao::class)->create();
        $editedRefeicao = factory(Refeicao::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/refeicaos/'.$refeicao->id,
            $editedRefeicao
        );

        $this->assertApiResponse($editedRefeicao);
    }

    /**
     * @test
     */
    public function test_delete_refeicao()
    {
        $refeicao = factory(Refeicao::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/refeicaos/'.$refeicao->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/refeicaos/'.$refeicao->id
        );

        $this->response->assertStatus(404);
    }
}
