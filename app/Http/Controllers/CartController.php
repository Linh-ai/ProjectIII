<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    public function addCart(Request $request)
    {
        $pattern = '/^\d+$/';
        $data = $request->query();
        $id = (int)$data['id'];
        $quantity = (int)$data['quantity'];
        $product = $this->productRepository->find($id);
        $carts = Session::get('cart');

        if(preg_match($pattern, $quantity))
        {
            if ($quantity > 0)
            {
                if (isset($carts[$id])) {
                    if ($carts[$id]['product_quantity'] + $quantity <= $product->product_quantity) {
                        $carts[$id]['product_quantity'] += $quantity;
                    }
                }
                else{
                    $carts[$id] = array(
                        'product_id' => $id,
                        'product_quantity' => $quantity,
                        'product_size' => $data['size']
                    );
                }
                Session::put('cart', $carts);
            }
            else
                return redirect()->back()->with('msg', 'âu no');
        }
        else
            return redirect()->back()->with('msg', 'âu no');
    }

    public function showMiniCart()
    {
        $carts = Session::get('cart');

        if ($carts){
            foreach ($carts as $cart){
                $id = $cart['product_id'];
                $products = $this->productRepository->find($id);
                $carts[$id]['product_name'] = $products->name;
                $carts[$id]['product_price'] = (int)$products->price;
                $carts[$id]['product_image'] = $products->image;
            }
        }
        Session::put('cart', $carts);

        return view('layouts.front_voxo',[
            'carts'=> $carts
        ]);
    }
}
