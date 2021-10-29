<?php namespace Tests\Repositories;

use App\Models\Turma;
use App\Repositories\TurmaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TurmaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TurmaRepository
     */
    protected $turmaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->turmaRepo = \App::make(TurmaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_turma()
    {
        $turma = factory(Turma::class)->make()->toArray();

        $createdTurma = $this->turmaRepo->create($turma);

        $createdTurma = $createdTurma->toArray();
        $this->assertArrayHasKey('id', $createdTurma);
        $this->assertNotNull($createdTurma['id'], 'Created Turma must have id specified');
        $this->assertNotNull(Turma::find($createdTurma['id']), 'Turma with given id must be in DB');
        $this->assertModelData($turma, $createdTurma);
    }

    /**
     * @test read
     */
    public function test_read_turma()
    {
        $turma = factory(Turma::class)->create();

        $dbTurma = $this->turmaRepo->find($turma->id);

        $dbTurma = $dbTurma->toArray();
        $this->assertModelData($turma->toArray(), $dbTurma);
    }

    /**
     * @test update
     */
    public function test_update_turma()
    {
        $turma = factory(Turma::class)->create();
        $fakeTurma = factory(Turma::class)->make()->toArray();

        $updatedTurma = $this->turmaRepo->update($fakeTurma, $turma->id);

        $this->assertModelData($fakeTurma, $updatedTurma->toArray());
        $dbTurma = $this->turmaRepo->find($turma->id);
        $this->assertModelData($fakeTurma, $dbTurma->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_turma()
    {
        $turma = factory(Turma::class)->create();

        $resp = $this->turmaRepo->delete($turma->id);

        $this->assertTrue($resp);
        $this->assertNull(Turma::find($turma->id), 'Turma should not exist in DB');
    }
}
