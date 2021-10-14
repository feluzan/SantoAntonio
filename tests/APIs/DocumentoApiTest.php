<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Documento;

class DocumentoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_documento()
    {
        $documento = factory(Documento::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/documentos', $documento
        );

        $this->assertApiResponse($documento);
    }

    /**
     * @test
     */
    public function test_read_documento()
    {
        $documento = factory(Documento::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/documentos/'.$documento->id
        );

        $this->assertApiResponse($documento->toArray());
    }

    /**
     * @test
     */
    public function test_update_documento()
    {
        $documento = factory(Documento::class)->create();
        $editedDocumento = factory(Documento::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/documentos/'.$documento->id,
            $editedDocumento
        );

        $this->assertApiResponse($editedDocumento);
    }

    /**
     * @test
     */
    public function test_delete_documento()
    {
        $documento = factory(Documento::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/documentos/'.$documento->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/documentos/'.$documento->id
        );

        $this->response->assertStatus(404);
    }
}
