<?php namespace Tests\Repositories;

use App\Models\UserRoles;
use App\Repositories\UserRolesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserRolesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserRolesRepository
     */
    protected $userRolesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userRolesRepo = \App::make(UserRolesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_roles()
    {
        $userRoles = factory(UserRoles::class)->make()->toArray();

        $createdUserRoles = $this->userRolesRepo->create($userRoles);

        $createdUserRoles = $createdUserRoles->toArray();
        $this->assertArrayHasKey('id', $createdUserRoles);
        $this->assertNotNull($createdUserRoles['id'], 'Created UserRoles must have id specified');
        $this->assertNotNull(UserRoles::find($createdUserRoles['id']), 'UserRoles with given id must be in DB');
        $this->assertModelData($userRoles, $createdUserRoles);
    }

    /**
     * @test read
     */
    public function test_read_user_roles()
    {
        $userRoles = factory(UserRoles::class)->create();

        $dbUserRoles = $this->userRolesRepo->find($userRoles->id);

        $dbUserRoles = $dbUserRoles->toArray();
        $this->assertModelData($userRoles->toArray(), $dbUserRoles);
    }

    /**
     * @test update
     */
    public function test_update_user_roles()
    {
        $userRoles = factory(UserRoles::class)->create();
        $fakeUserRoles = factory(UserRoles::class)->make()->toArray();

        $updatedUserRoles = $this->userRolesRepo->update($fakeUserRoles, $userRoles->id);

        $this->assertModelData($fakeUserRoles, $updatedUserRoles->toArray());
        $dbUserRoles = $this->userRolesRepo->find($userRoles->id);
        $this->assertModelData($fakeUserRoles, $dbUserRoles->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_roles()
    {
        $userRoles = factory(UserRoles::class)->create();

        $resp = $this->userRolesRepo->delete($userRoles->id);

        $this->assertTrue($resp);
        $this->assertNull(UserRoles::find($userRoles->id), 'UserRoles should not exist in DB');
    }
}
