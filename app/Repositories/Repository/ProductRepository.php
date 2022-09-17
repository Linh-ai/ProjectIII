<?php
namespace App\Repositories\Repository;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {

    //ghi de ham abstract getmodel
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Product::class;
    }
}
