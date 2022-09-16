<?php
namespace App\Repositories\Repository;

use App\Repositories\RepositoryInterface\CategoryRepositoryInterface;
use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {

    //trien khai ham abstract, tra ve model tuong ung
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Category::class;
    }
}
