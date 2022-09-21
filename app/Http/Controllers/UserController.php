<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;
    //protected $orderRepository;

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

    //tao giao dien dang ki va xu ly du lieu
    public function register(){
        return view('user.register');
    }
    public function create(RegisterRequest $request) {
        if ($this->userRepository->checkExistEmail($request->email)){
            return redirect()->back()->with('statusRegister', 'An account already exists with this email address.');
        }
        $confirmToken = rand(100000, 999999);
        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'address' => $request['address'],
            'password' => bcrypt($request['password']),
            'confirmToken' => $confirmToken
        ];
        if (! $this->userRepository->create($data)) {
            return redirect()->back()->with('msg', 'fail');
        }
        if ($this->userRepository->updateStatusByEmail($request['email'])){
            return redirect()->route('loginuser')->with('msg', 'success');
        }

    }

    public function login()
    {
        return view('user.login');
    }
    public function checkLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::guard('user')->attempt($credentials)) {

            if ($this->userRepository->checkRoleUser($request->email)[0]['role'] == 'admin') {
                return redirect()->route('all_users');
            }

            return redirect()->route('home')->with('msg', 'success');
        }

        else {
            return redirect()->back()->with('statusLogin', 'Email or password is incorrect');
        }

    }

    public function dashboard(){
        $user = Auth::guard('user')->user();
        $id = $user->id;
        $orders = [];
        $orderDetail = [];

        return view('user.user_dashboard', [
            'user' => $user,
            'orders' => $orders,
            'orderDetails' => $orderDetail
        ]);
    }

    public function logout(){
        $user = Auth::guard('user')->user();

        Auth::guard('user')->logout();
        return redirect()->route('home')->with('msg', 'success');
    }
}
