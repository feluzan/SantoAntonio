<?php namespace Tests\Repositories;

use App\Models\Refeicao;
use App\Repositories\RefeicaoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RefeicaoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RefeicaoRepository
     */
    protected $refeicaoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->refeicaoRepo = \App::make(RefeicaoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_refeicao()
    {
        $refeicao = factory(Refeicao::class)->make()->toArray();

        $createdRefeicao = $this->refeicaoRepo->create($refeicao);

        $createdRefeicao = $createdRefeicao->toArray();
        $this->assertArrayHasKey('id', $createdRefeicao);
        $this->assertNotNull($createdRefeicao['id'], 'Created Refeicao must have id specified');
        $this->assertNotNull(Refeicao::find($createdRefeicao['id']), 'Refeicao with given id must be in DB');
        $this->assertModelData($refeicao, $createdRefeicao);
    }

    /**
     * @test read
     */
    public function test_read_refeicao()
    {
        $refeicao = factory(Refeicao::class)->create();

        $dbRefeicao = $this->refeicaoRepo->find($refeicao->id);

        $dbRefeicao = $dbRefeicao->toArray();
        $this->assertModelData($refeicao->toArray(), $dbRefeicao);
    }

    /**
     * @test update
     */
    public function test_update_refeicao()
    {
        $refeicao = factory(Refeicao::class)->create();
        $fakeRefeicao = factory(Refeicao::class)->make()->toArray();

        $updatedRefeicao = $this->refeicaoRepo->update($fakeRefeicao, $refeicao->id);

        $this->assertModelData($fakeRefeicao, $updatedRefeicao->toArray());
        $dbRefeicao = $this->refeicaoRepo->find($refeicao->id);
        $this->assertModelData($fakeRefeicao, $dbRefeicao->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_refeicao()
    {
        $refeicao = factory(Refeicao::class)->create();

        $resp = $this->refeicaoRepo->delete($refeicao->id);

        $this->assertTrue($resp);
        $this->assertNull(Refeicao::find($refeicao->id), 'Refeicao should not exist in DB');
    }
}
