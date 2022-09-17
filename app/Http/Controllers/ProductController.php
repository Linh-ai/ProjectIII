<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Repositories\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $brandRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        BrandRepositoryInterface $brandRepository
    ){
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
    }

    public function list(){
        $products = $this->productRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        $brands = $this->brandRepository->getAll();
        return view('admin.all_products', [
            'products' => $products,
            'catgories'=> $categories,
            'brands' => $brands
        ]);
    }

    //hien thi man hinh them moi product va xu ly
    public function viewAdd(){
        $categories = $this->categoryRepository->getAll();
        $brands = $this->brandRepository->getAll();

        return view('admin.add_new_product', [
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
    public function create(AddProductRequest $request){
        $categories = $this->categoryRepository->getAll();
        $brands = $this->brandRepository->getAll();

        if (! $request -> hasFile('image') ){
            return view('admin.add_new_product')->with('msg', 'Chọn file ảnh đê');
        }
        $image = $request -> file('image');
        $image_name = time().'_'.$image -> getClientoriginalName();
        $image->move('images', $image_name);
        $data = [
            'name' => $request['name'],
            'price' => (float) $request['price'],
            'image' => $image_name,
            'category_id' => $request['category_id'],
            'brand_id' => $request['brand_id'],
            'product_quantity' => (int) $request['quantity'],
            'description' => $request->description
        ];

        if (! $this->productRepository->create($data)){
            return view('admin.add_new_product', [
                'categories' => $categories,
                'brands' => $brands
            ]);
        }

        return view('admin.add_new_product', [
            'categories' => $categories,
            'brands' => $brands,
            'msg' => 'OKE !'
        ]);
    }

    //show giao dien sua thong tin va update
    public function show($id){
        $brands = $this->brandRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        $product = $this->productRepository->find($id);

        if (! $product){
            return redirect()-> route('all_products')->with('msg', 'fail');
        }
        return view('admin.edit_product', [
            'product' => $product,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }
    public function update(int $id, Request $request) {
        $brands = $this->brandRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        $product = $this->productRepository->find($id);

        if (! $product){
            redirect()->route('all_product')->with('msg', 'fail');
        }

        if ( $request -> hasFile('image')){
            $image_edit = $request -> file('image');
            $image_name = time().'_'.$image_edit -> getClientoriginalName();
            $image_edit->move('images', $image_name);

            $data = [
                'name' => $request->name,
                'price' => (float)$request->price,
                'image' => $image_name,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                //'product_quantity' => $product->product_quantity + (int) $request->quantity
                'product_quantity' => (int) $request->quantity
            ];
        }
        else {
            $data = [
                'name' => $request->name,
                'price' => (float) $request->price,
                'image' => $request->oldImage,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                //'product_quantity' => $product->product_quantity + (int) $request->quantity
                'product_quantity' => (int) $request->quantity
            ];
        }



        if (! $this->productRepository->update($id, $data)){
            return view('admin.edit_product', [
                'product' => $product,
                'brands' => $brands,
                'categories' => $categories
            ]);
        }

        return redirect()->route('all_products')->with('msg', 'success');
    }

    public function destroy($id){
        if (! $this->productRepository->delete($id)){
            return redirect()-> route('all_products')->with('msg', 'fail');
        }

        return redirect()-> route('all_products')->with('msg', 'success');
    }
}
