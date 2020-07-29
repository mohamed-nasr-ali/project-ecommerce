<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequests\ProductStoreRequest;
use App\Http\Requests\ProductRequests\ProductUpdateUnitesRequest;
use App\Http\Requests\ProductRequests\ProductUploadImage;
use App\Product;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository=$productRepository;
    }
    public function index()
    {
        return $this->productRepository->index();
    }

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
        return $this->productRepository->store($validated);
    }

    public function show($id)
    {
        return $this->productRepository->show($id);
    }

    public function uploadFile(ProductUploadImage $request)
    {
        $validated = $request->validated();
        return $this->productRepository->uploadFile($validated['image']);

    }

    public function update(ProductStoreRequest $request,$id)
    {
        $validated = $request->validated();
        return $this->productRepository->update($validated,$id);
    }

    public function updateUnits(ProductUpdateUnitesRequest $request,  $id)
    {
        $validated = $request->validated();
        return $this->productRepository->updateUnits($validated,$id);
    }

    public function destroy($id)
    {
        return $this->productRepository->delete($id);
    }
}
