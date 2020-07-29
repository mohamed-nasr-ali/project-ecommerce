<?php
namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Model as ModelAlias;

interface OrderInterface{
    public function index();
    /**
     * @param array $attributes
     * @return ModelAlias
     */
    public function store(array $attributes);
    /**
     * @param $id
     * @return ModelAlias
     */
    public function show($id);
    public function deliverOrder($product);
}
