<?php
namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Model as ModelAlias;

interface UserInterface{
    public function index();
    public function login(array $attributes);
    public function register(array $attributes);

    /**
     * @param $id
     * @return ModelAlias
     */
    public function show($id);
    public function userOrders($id);
}
