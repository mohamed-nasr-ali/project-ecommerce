<?php
namespace App\Repositories\Eloquent;


use App\Repositories\Interfaces\ProductInterface;
use App\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;

class ProductRepository implements ProductInterface
{
    use UploadTrait;
    // model property on class instances
    protected $model;
    // Constructor to bind model to repo
    public function __construct(Product $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        return response()->json($this->model::all(),200);
    }

    public function store(array $attributes)
    {
        $product = $this->model->create($attributes);
        return response()->json([
            'status' => (bool) $product,
            'data'   => $product,
            'message' => $product ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function show($id)
    {
        $record=$this->getModel($id);
        return response()->json($record,200);
    }

    public function update(array $data, $id)
    {
        $record = $this->getModel($id);
        if ( $data['image']===null || $data['image']===$record->image){
            unset($data['image']);
        } else{
            if (isset($record->image) || $record->image !== "" ){
                File::delete($record->image);
            }
        }
        $updated=$record->update($data);
        return response()->json([
             'status' => $updated,
             'message' => $updated ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function updateUnits($quantity,$id)
    {
        $record = $this->getModel($id);
        $status=$record->update(['units' => $record->units-=$quantity]);
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Units Added!' : 'Error Adding Product Units'
        ]);
    }
    private function getModel($id){
        return $this->model->findOrFail($id);
    }

    public function uploadFile($file)
    {
        // Check if a profile image has been uploaded
        if (isset($file)) {
            // Make a image name based on user name and current timestamp
            $name = Str::slug($file).'_'.time();
            // Define folder path
            $folder = 'ecommerce_products_images/';
            // Upload image
            $image=$this->uploadOne($file, $folder, 'public', $name);
            return response()->json((string)$image,201);

        }else{
            return response()->json(404,['error'=>'your file is not uploaded yet try again']);
        }
    }

    public function delete($id)
    {
        $record = $this->getModel($id);
        $status = $record->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
