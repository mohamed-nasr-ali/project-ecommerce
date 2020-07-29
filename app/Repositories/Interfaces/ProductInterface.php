<?php
namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Model as ModelAlias;

interface ProductInterface{
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
    public function update(array $data, $id);
    public function updateUnits(array $data, $product);
}
