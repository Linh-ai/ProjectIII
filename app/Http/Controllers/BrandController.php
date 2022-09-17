<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBrandRequest;
use App\Repositories\RepositoryInterface\BrandRepositoryInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(
        BrandRepositoryInterface $brandRepository
    ) {
        $this->brandRepository = $brandRepository;
    }

    //tra ve tat ca brand
    public function list(){
        $brands = $this->brandRepository->getAll();
        return view('admin.all_brands', [
            'brands' => $brands
        ]);
    }

    //tra ve man hinh them brand va xu ly them brand
    public function viewAdd(){
        return view('admin.add_new_brand');
    }
    public function create(AddBrandRequest $request) {
        $image = $request->file('image');
        $image_name = time().'_'.$image->getClientOriginalName();
        $image->move('images', $image_name);

        $data = [
            'name' => $request->name,
            'image'=> $image_name,
            'status' => $request->status
        ];

        if (! $this->brandRepository->create($data)) {
            return view('admin.add_new_brand', ['msg' => 'fail']);
        }
        return view('admin.add_new_brand', ['msg' => 'success']);
    }

    //tra ve man hinh sua brand va xu ly sua brand
    public function show($id) {
        $brand = $this->brandRepository->find($id);
        if (! $brand) {
            redirect()->route('all_brands')->with('msg', 'fail');
        }
        return view('admin.edit_brand', [
            'brand' => $brand
        ]);
    }
    public function update(int $id, Request $request){
        $brand = $this->brandRepository->find($id);

        if (! $brand){
            redirect()->route()->with('msg', 'fail');
        }

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().'_'.$image->getClientOriginalName();
            $image->move('images', $image_name);

            $data = [
                'name' => $request->name,
                'image' => $image_name,
                'status' => $request->status
            ];
        }
        else {
            $data = [
                'name' => $request['name'],
                'image' => $request->oldImage,
                'status' => $request['status']
            ];
        }

        if (! $this->brandRepository->update($id, $data)){
            return view('voxo_backends.edit_brand',[
                'brand' => $brand
            ]);
        }

        return redirect()->route('all_brands')->with('msg', 'success');
    }

    public function destroy($id){
        if (! $this->brandRepository->delete($id)){
            return redirect()->route('all_brands')->with('msg', 'fail');
        }

        return redirect()->route('all_brands')->with('msg', 'fail');
    }
}
