<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Traits\ResponseData;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
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
        //authorized 403
        Gate::authorize('category-access');

        if($request->ajax()){
            return $this->category->allData($request);
        }

        $this->setPageTitle('Category List');
        $data['breadcrumb'] = ['Categories' => ''];
        return view('backend.blog.category.index', $data);
    }

    public function storeOrUpdate(CategoryRequest $request){
        if($request->ajax()){
            if(permission('category-create') || permission('category-edit')){
                return $this->category->storeOrUpdateData($request);
            }else{
                return $this->responseJson('error',UNAUTHORIZED_MSG);
            }
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            if(permission('category-edit')){
                return $this->category->editData($request->id);
            }else{
                return $this->responseJson('error',UNAUTHORIZED_MSG);
            }
        }
    }

    public function delete(Request $request){
        if($request->ajax()){
            if(permission('category-delete')){
                return $this->category->deleteData($request->id);
            }else{
                return $this->responseJson('error',UNAUTHORIZED_MSG);
            }
        }
    }

    public function statusChange(Request $request){
        if($request->ajax()){
            if(permission('category-status')){
                return $this->category->statusData($request->id, $request->status);
            }else{
                return $this->responseJson('error',UNAUTHORIZED_MSG);
            }
        }
    }
}
