<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use Flash;
use Response;

use App\User;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        if(isset($input['search'])){
            $searchTerm = $input['search'];
            $user = User::query()
                        ->where('name', 'LIKE', "%{$searchTerm}%") 
                        ->orWhere('username', 'LIKE', "%{$searchTerm}%") 
                        ->get();

        }else{
            $user = $this->userRepository->all();
        }

        return view('user.index')
            ->with('user', $user);
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User  not found');

            return redirect(route('user.index'));
        }

        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('user.index'));
        }

        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuário não encontrado.');

            return redirect(route('user.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('Usuário atualizado com sucesso!');

        return redirect(route('user.index'));
    }
}
