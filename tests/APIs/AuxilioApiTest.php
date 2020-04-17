<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Auxilio;

class AuxilioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_auxilio()
    {
        $auxilio = factory(Auxilio::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/auxilios', $auxilio
        );

        $this->assertApiResponse($auxilio);
    }

    /**
     * @test
     */
    public function test_read_auxilio()
    {
        $auxilio = factory(Auxilio::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/auxilios/'.$auxilio->id
        );

        $this->assertApiResponse($auxilio->toArray());
    }

    /**
     * @test
     */
    public function test_update_auxilio()
    {
        $auxilio = factory(Auxilio::class)->create();
        $editedAuxilio = factory(Auxilio::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/auxilios/'.$auxilio->id,
            $editedAuxilio
        );

        $this->assertApiResponse($editedAuxilio);
    }

    /**
     * @test
     */
    public function test_delete_auxilio()
    {
        $auxilio = factory(Auxilio::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/auxilios/'.$auxilio->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/auxilios/'.$auxilio->id
        );

        $this->response->assertStatus(404);
    }
}
