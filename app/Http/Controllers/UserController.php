<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use Flash;
use Response;
use Image;

use App\User;
use App\Models\Turma;

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
    public function index(Request $request){
        $input = $request->all();
        if(isset($input['search'])){
            $searchTerm = $input['search'];
            $user = $this->userRepository->allNotArchived([
                'name' => ['operator'=> 'like', 'value' => '%' . $searchTerm . '%', 'boolean' => 'or'],
                'username' => ['operator'=> 'like', 'value' => '%' . $searchTerm . '%', 'boolean' => 'or'],
            ]);
        }else{
            $user = $this->userRepository->allNotArchived();
        }

        return view('user.index')->with('user', $user);
    }

    public function archivedIndex(Request $request){
        $input = $request->all();
        if(isset($input['search'])){
            $searchTerm = $input['search'];
            $user = $this->userRepository->allArchived([
                'name' => ['operator'=> 'like', 'value' => '%' . $searchTerm . '%', 'boolean' => 'or'],
                'username' => ['operator'=> 'like', 'value' => '%' . $searchTerm . '%', 'boolean' => 'or'],
            ]);

        }else{
            $user = $this->userRepository->allArchived();
        }

        return view('user.index')->with('user', $user);
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

            return redirect(route('users.index'));
        }
        
        $turmas = Turma::orderBy('nome')->pluck('nome','id')->toArray();
        $turmas[0] = "Sem turma";
        

        return view('user.edit',compact('turmas'))->with('user', $user);
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
        $input = $request->all();
        $user = $this->userRepository->find($id);

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = $user->getUsername() . "_" . time() . ".jpg";
            Image::make($avatar)->encode('jpg', 75)->save( public_path('uploads/avatars/' . $filename));
            $user['avatar'] = $filename;
        }

        if (empty($user)) {
            Flash::error('Usuário não encontrado.');

            return redirect(route('users.index'));
        }
        
        $user['turma_id'] = $input['turma_id'];
        $user->save();

        Flash::success('Usuário atualizado com sucesso!');

        return redirect(route('users.index'));
    }

    public function updateArchive($user_id, UpdateUserRequest $request){
        $input = $request->all();
        $user = $this->userRepository->find($user_id);
        $archive = $input['arquivado'];
        $user['arquivado'] = $archive;
        $user->save();
        return redirect()->back();
    }
}
