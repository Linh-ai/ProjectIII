<?php
namespace App\Repositories\Repository;

use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Order::class;
    }



    /**
     * @param $id
     *
     * @return mixed
     */
    public function findOrder($id)
    {
        $orders = $this->model->where('user_id', $id)->get();
        return $orders;
    }
}
