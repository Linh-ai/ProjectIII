<?php
namespace App\Repositories\Repository;

use App\Models\Brand;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface\BrandRepositoryInterface;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface {
    //tra ve class Brand
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Brand::class;
    }
}
