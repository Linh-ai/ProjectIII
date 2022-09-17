<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function list(){
        $users = $this->userRepository->getAll();

        return view('admin.all_users',[
            'users' => $users
        ]);
    }

    public function show(int $id)
    {
        $user = $this->userRepository->find($id);

        if (! $user){
            redirect()->route('all_users')->with('msg', 'fail');
        }

        return view('admin.edit_user', [
            'user' => $user
        ]);
    }
    public function update(int $id, Request $request) {
        $user = $this->userRepository->find($id);
        if (! $user){
            return redirect()->route('all_users')->with('msg', 'fail');
        }

        $data = [
            'role' => $request['role'],
        ];

        $this->userRepository->update($id, $data);

        return redirect()->route('all_users')->with('msg', 'success');
    }
}
