<?php

namespace App\Http\Controllers\Blog;

use App\Traits\ResponseData;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    use ResponseData;

    protected $category;

    public function __construct(CategoryService $categoryService)
    {
        $this->category = $categoryService;
    }

    public function index(Request $request){
        if($request->ajax()){
            return $this->category->allData($request);
        }

        $this->setPageTitle('Category List');
        $data['breadcrumb'] = ['Categories' => ''];
        return view('blog.category.index', $data);
    }

    public function storeOrUpdate(CategoryRequest $request){
        if($request->ajax()){
            return $this->category->storeOrUpdateData($request);
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            return $this->category->editData($request->id);
        }
    }

    public function delete(Request $request){
        if($request->ajax()){
            return $this->category->deleteData($request->id);
        }
    }

    public function statusChange(Request $request){
        if($request->ajax()){
            return $this->category->statusData($request->id, $request->status);
        }
    }
}
