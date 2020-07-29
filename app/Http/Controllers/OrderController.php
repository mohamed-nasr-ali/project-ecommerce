<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequests\OrderStoreRequest;
use App\Http\Requests\OrderRequests\OrderUpdateRequest;
use App\Order;
use App\Repositories\Eloquent\OrderRepository;

class OrderController extends Controller
{
    protected $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository=$orderRepository;
    }

    public function index()
    {
        return $this->orderRepository->index();
    }

    public function deliverOrder($id)
    {
        return $this->orderRepository->deliverOrder($id);
    }

    public function store(OrderStoreRequest $request)
    {
        $validated=$request->validated();
        return $this->orderRepository->store($validated);
    }

    public function show($id)
    {
        return $this->orderRepository->show($id);
    }
}
