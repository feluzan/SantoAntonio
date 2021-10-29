<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Turma;

class TurmaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_turma()
    {
        $turma = factory(Turma::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/turmas', $turma
        );

        $this->assertApiResponse($turma);
    }

    /**
     * @test
     */
    public function test_read_turma()
    {
        $turma = factory(Turma::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/turmas/'.$turma->id
        );

        $this->assertApiResponse($turma->toArray());
    }

    /**
     * @test
     */
    public function test_update_turma()
    {
        $turma = factory(Turma::class)->create();
        $editedTurma = factory(Turma::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/turmas/'.$turma->id,
            $editedTurma
        );

        $this->assertApiResponse($editedTurma);
    }

    /**
     * @test
     */
    public function test_delete_turma()
    {
        $turma = factory(Turma::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/turmas/'.$turma->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/turmas/'.$turma->id
        );

        $this->response->assertStatus(404);
    }
}
