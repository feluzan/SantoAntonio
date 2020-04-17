<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserRoles;

class UserRolesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_roles()
    {
        $userRoles = factory(UserRoles::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_roles', $userRoles
        );

        $this->assertApiResponse($userRoles);
    }

    /**
     * @test
     */
    public function test_read_user_roles()
    {
        $userRoles = factory(UserRoles::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/user_roles/'.$userRoles->id
        );

        $this->assertApiResponse($userRoles->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_roles()
    {
        $userRoles = factory(UserRoles::class)->create();
        $editedUserRoles = factory(UserRoles::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_roles/'.$userRoles->id,
            $editedUserRoles
        );

        $this->assertApiResponse($editedUserRoles);
    }

    /**
     * @test
     */
    public function test_delete_user_roles()
    {
        $userRoles = factory(UserRoles::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_roles/'.$userRoles->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_roles/'.$userRoles->id
        );

        $this->response->assertStatus(404);
    }
}
