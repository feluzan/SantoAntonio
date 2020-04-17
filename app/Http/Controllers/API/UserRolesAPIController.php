<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserRolesAPIRequest;
use App\Http\Requests\API\UpdateUserRolesAPIRequest;
use App\Models\UserRoles;
use App\Repositories\UserRolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserRolesController
 * @package App\Http\Controllers\API
 */

class UserRolesAPIController extends AppBaseController
{
    /** @var  UserRolesRepository */
    private $userRolesRepository;

    public function __construct(UserRolesRepository $userRolesRepo)
    {
        $this->userRolesRepository = $userRolesRepo;
    }

    /**
     * Display a listing of the UserRoles.
     * GET|HEAD /userRoles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $userRoles = $this->userRolesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($userRoles->toArray(), 'User Roles retrieved successfully');
    }

    /**
     * Store a newly created UserRoles in storage.
     * POST /userRoles
     *
     * @param CreateUserRolesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRolesAPIRequest $request)
    {
        $input = $request->all();

        $userRoles = $this->userRolesRepository->create($input);

        return $this->sendResponse($userRoles->toArray(), 'User Roles saved successfully');
    }

    /**
     * Display the specified UserRoles.
     * GET|HEAD /userRoles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var UserRoles $userRoles */
        $userRoles = $this->userRolesRepository->find($id);

        if (empty($userRoles)) {
            return $this->sendError('User Roles not found');
        }

        return $this->sendResponse($userRoles->toArray(), 'User Roles retrieved successfully');
    }

    /**
     * Update the specified UserRoles in storage.
     * PUT/PATCH /userRoles/{id}
     *
     * @param int $id
     * @param UpdateUserRolesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRolesAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserRoles $userRoles */
        $userRoles = $this->userRolesRepository->find($id);

        if (empty($userRoles)) {
            return $this->sendError('User Roles not found');
        }

        $userRoles = $this->userRolesRepository->update($input, $id);

        return $this->sendResponse($userRoles->toArray(), 'UserRoles updated successfully');
    }

    /**
     * Remove the specified UserRoles from storage.
     * DELETE /userRoles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var UserRoles $userRoles */
        $userRoles = $this->userRolesRepository->find($id);

        if (empty($userRoles)) {
            return $this->sendError('User Roles not found');
        }

        $userRoles->delete();

        return $this->sendSuccess('User Roles deleted successfully');
    }
}
