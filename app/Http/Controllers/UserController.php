<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests\UserLoginRequest;
use App\Http\Requests\UserRequests\UserRegistrationRequest;
use App\Repositories\Eloquent\UserRepository;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository=$userRepository;
    }
    public function index(){
        return $this->userRepository->index();
    }
    public function login(UserLoginRequest $request)
    {
        $validated=$request->validated();
        return $this->userRepository->login($validated);
    }

    public function register(UserRegistrationRequest $request)
    {
        $validated=$request->validated();
        return $this->userRepository->register($validated);
    }

    public function show($id)
    {
        return $this->userRepository->show($id);
    }

    public function showOrders($id)
    {
        return  $this->userRepository->userOrders($id);
    }
}
