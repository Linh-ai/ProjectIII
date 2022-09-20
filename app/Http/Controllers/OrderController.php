<?php

namespace App\Http\Controllers;

use App\Repositories\Repository\OrderDetailRepository;
use App\Repositories\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\RepositoryInterface\OrderRepositoryInterface;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $orderDetailRepository;
    public function __construct(
        OrderRepositoryInterface $orderRepository
        //OrderDetailRepositoryInterface $orderDetailRepository
    )
    {
        $this->orderRepository = $orderRepository;
        //$this->orderDetailRepository = $orderDetailRepository;


    }
    public function update(int $id,Request $request)
    {
        $status = $request->status;

        $data = [
            'status' => $status
        ];

        if(! $this->orderRepository->update($id, $data))
        {
            return redirect()->back()->with('msg', 'fail');
        }

        return redirect()->route('list_order')->with('msg', 'success');
    }

    public function view()
    {
        $orders = $this->orderRepository->getAll();

        return view('admin.order_list',[
            'orders' => $orders
        ]);
    }

    public function show(int $id)
    {
        $order = $this->orderRepository->find($id);

        return view('admin.edit_order',[
            'order' => $order
        ]);
    }

    public function delete(int $id)
    {
        $orderDetails = $this->orderDetailRepository->getAll();

        foreach ($orderDetails as $orderDetail){
            if ($orderDetail->order->id == $id){
                if (! $this->orderDetailRepository->delete($orderDetail->id)){
                    return redirect()->back()->with('msg', 'fail');
                }
            }
        }

        if (! $this->orderRepository->delete($id)){
            return redirect()->back()->with('msg', 'fail');
        }

        return redirect()->route('list_order')->with('msg', 'success');
    }

    public function detail($id)
    {
        $orderDetails = $this->orderDetailRepository->detail($id);
        $order = $this->orderRepository->find($id);

        return view('admin.detail_order', [
            'order' => $order,
            'orderDetails' => $orderDetails
        ]);
    }
}
