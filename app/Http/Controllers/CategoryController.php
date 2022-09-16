<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Repositories\Repository\CategoryRepository;
use Illuminate\Http\Request;
use App\Repositories\RepositoryInterface\CategoryRepositoryInterface;


class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function list(){
        $categories = $this->categoryRepository->getAll();

        return view('admin.all_categories', [
            'categories' => $categories
        ]);
    }

    public function viewAdd(){
        return view('admin.add_new_category');
    }

    public function create(AddCategoryRequest $request) {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ];

        if (! $this->categoryRepository->create($data)) {
            return view('admin.add_new_category')->with('msg', 'fail');
        }
        return view('admin.add_new_category')->with('msg', 'success');
    }

    public function show($id) {
        $category = $this->categoryRepository->find($id);

        if (!$category){
            return view('admin.all_categories')->with('msg', 'fail');
        }

        return view('admin.edit_category', [
            'category' => $category
        ]);
    }

    public function update($id, Request $request) {
        $category = $this->categoryRepository->find($id);

        if (!$category){
            return view('admin.all_categories', [
                'msg', 'fail'
            ]);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ];
        $this->categoryRepository->update($id, $data);
        return redirect()->route('all_categories')->with('msg', 'success');
    }

    public function destroy($id) {
        if (! $this->categoryRepository->delete($id)) {
            return redirect()->route('all_categories')->with('msg', 'fail');
        }

        return redirect()->route('all_categories')->with('msg', 'success');
    }
}
