<?php namespace Tests\Repositories;

use App\Models\Auxilio;
use App\Repositories\AuxilioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AuxilioRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AuxilioRepository
     */
    protected $auxilioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->auxilioRepo = \App::make(AuxilioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_auxilio()
    {
        $auxilio = factory(Auxilio::class)->make()->toArray();

        $createdAuxilio = $this->auxilioRepo->create($auxilio);

        $createdAuxilio = $createdAuxilio->toArray();
        $this->assertArrayHasKey('id', $createdAuxilio);
        $this->assertNotNull($createdAuxilio['id'], 'Created Auxilio must have id specified');
        $this->assertNotNull(Auxilio::find($createdAuxilio['id']), 'Auxilio with given id must be in DB');
        $this->assertModelData($auxilio, $createdAuxilio);
    }

    /**
     * @test read
     */
    public function test_read_auxilio()
    {
        $auxilio = factory(Auxilio::class)->create();

        $dbAuxilio = $this->auxilioRepo->find($auxilio->id);

        $dbAuxilio = $dbAuxilio->toArray();
        $this->assertModelData($auxilio->toArray(), $dbAuxilio);
    }

    /**
     * @test update
     */
    public function test_update_auxilio()
    {
        $auxilio = factory(Auxilio::class)->create();
        $fakeAuxilio = factory(Auxilio::class)->make()->toArray();

        $updatedAuxilio = $this->auxilioRepo->update($fakeAuxilio, $auxilio->id);

        $this->assertModelData($fakeAuxilio, $updatedAuxilio->toArray());
        $dbAuxilio = $this->auxilioRepo->find($auxilio->id);
        $this->assertModelData($fakeAuxilio, $dbAuxilio->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_auxilio()
    {
        $auxilio = factory(Auxilio::class)->create();

        $resp = $this->auxilioRepo->delete($auxilio->id);

        $this->assertTrue($resp);
        $this->assertNull(Auxilio::find($auxilio->id), 'Auxilio should not exist in DB');
    }
}
