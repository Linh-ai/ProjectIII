<?php

namespace App\Http\Controllers;

use App\Repositories\Repository\CategoryRepository;
use App\Repositories\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productRepository;
    protected $brandRepository;
    protected $categoryRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        BrandRepositoryInterface $brandRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function home(){
        return view('user.home');
    }

    public function productlist(){
        $products = $this->productRepository->getAll();
        $brands = $this->brandRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        return view('user.product_list', [
            'products' => $products,
            'brands' => $brands,
            'categories'  => $categories
        ]);
    }

    public function productDetail($id) {
        $product = $this->productRepository->find($id);

        return view('user.product_detail', [
            'product' => $product
        ]);
    }
}
