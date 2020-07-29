<?php
namespace App\Repositories\Eloquent;


use App\Order;
use App\Repositories\Interfaces\OrderInterface;
use Illuminate\Support\Facades\Auth;


class OrderRepository implements OrderInterface
{
    protected  $productRepository;
    // model property on class instances
    protected $model;
    // Constructor to bind model to repo
    public function __construct(Order $model,ProductRepository $productRepository)
    {
        $this->model = $model;
        $this->productRepository = $productRepository;
    }


    public function index()
    {
        return response()->json($this->with(['product'=>function ($q){
            $q->withTrashed();
        }])->get(),200);
    }

    public function store(array $attributes)
    {
        $attributes = array_merge($attributes,['user_id'=>Auth::id()]);
        $order = $this->model->create($attributes);
        $this->productRepository->updateUnits($attributes['quantity'],$attributes['product_id']);
        return response()->json([
            'status' => (bool) $order,
            'data'   => $order,
            'message' => $order ? 'Order Created!' : 'Error Creating Order'
        ]);
    }

    public function show($id)
    {
        $record=$this->getModel($id);
        return response()->json($record,200);
    }

    public function deliverOrder($id)
    {
        $record = $this->getModel($id);
        $order=$record->update(['is_delivered' => 1]);
        return response()->json([
            'status'    => (bool)$order,
            'data'      => $order,
            'message'   => (bool)$order ? 'Order Delivered!' : 'Error Delivering Order'
        ]);
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
