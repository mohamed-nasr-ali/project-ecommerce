<?php
namespace App\Repositories\Eloquent;


use App\Repositories\Interfaces\UserInterface;
use App\User;
use Illuminate\Support\Facades\Auth;


class UserRepository implements UserInterface
{

    // model property on class instances
    protected $model;
    // Constructor to bind model to repo
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        return response()->json($this->with('orders')->get(), 200);
    }

    public function login(array $attributes)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];
        if (Auth::attempt($attributes)) {
            $status = 200;
            $response = [
                'token' => Auth::user()->createToken('bigStore')->accessToken,
                'user' => Auth::user()
            ];
        }

        return response()->json($response, $status);
    }

    public function register(array $attributes)
    {
        $pass=$attributes['password'];
        $data=['email'=>$attributes['email'],'password'=>$pass];
        $attributes['password'] = bcrypt($attributes['password']);
        $this->model->create($attributes);
        return $this->login($data);
    }

    public function show($id)
    {
        $record=$this->getModel($id);
        return response()->json($record,200);
    }

    public function userOrders($id)
    {
       $record=$this->getModel($id);
       return response()->json($record->orders()->with(['product'=>function ($q){
           $q->withTrashed();
       }])->get(),200);

    }
    // Eager load database relationships
    public function with($relations): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model::with($relations);
    }
    private function getModel($id){
        return $this->model->findOrFail($id);
    }
}
