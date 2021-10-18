<?php namespace Tests\Repositories;

use App\Models\PermissaoAcesso;
use App\Repositories\PermissaoAcessoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PermissaoAcessoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PermissaoAcessoRepository
     */
    protected $permissaoAcessoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->permissaoAcessoRepo = \App::make(PermissaoAcessoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_permissao_acesso()
    {
        $permissaoAcesso = factory(PermissaoAcesso::class)->make()->toArray();

        $createdPermissaoAcesso = $this->permissaoAcessoRepo->create($permissaoAcesso);

        $createdPermissaoAcesso = $createdPermissaoAcesso->toArray();
        $this->assertArrayHasKey('id', $createdPermissaoAcesso);
        $this->assertNotNull($createdPermissaoAcesso['id'], 'Created PermissaoAcesso must have id specified');
        $this->assertNotNull(PermissaoAcesso::find($createdPermissaoAcesso['id']), 'PermissaoAcesso with given id must be in DB');
        $this->assertModelData($permissaoAcesso, $createdPermissaoAcesso);
    }

    /**
     * @test read
     */
    public function test_read_permissao_acesso()
    {
        $permissaoAcesso = factory(PermissaoAcesso::class)->create();

        $dbPermissaoAcesso = $this->permissaoAcessoRepo->find($permissaoAcesso->id);

        $dbPermissaoAcesso = $dbPermissaoAcesso->toArray();
        $this->assertModelData($permissaoAcesso->toArray(), $dbPermissaoAcesso);
    }

    /**
     * @test update
     */
    public function test_update_permissao_acesso()
    {
        $permissaoAcesso = factory(PermissaoAcesso::class)->create();
        $fakePermissaoAcesso = factory(PermissaoAcesso::class)->make()->toArray();

        $updatedPermissaoAcesso = $this->permissaoAcessoRepo->update($fakePermissaoAcesso, $permissaoAcesso->id);

        $this->assertModelData($fakePermissaoAcesso, $updatedPermissaoAcesso->toArray());
        $dbPermissaoAcesso = $this->permissaoAcessoRepo->find($permissaoAcesso->id);
        $this->assertModelData($fakePermissaoAcesso, $dbPermissaoAcesso->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_permissao_acesso()
    {
        $permissaoAcesso = factory(PermissaoAcesso::class)->create();

        $resp = $this->permissaoAcessoRepo->delete($permissaoAcesso->id);

        $this->assertTrue($resp);
        $this->assertNull(PermissaoAcesso::find($permissaoAcesso->id), 'PermissaoAcesso should not exist in DB');
    }
}
