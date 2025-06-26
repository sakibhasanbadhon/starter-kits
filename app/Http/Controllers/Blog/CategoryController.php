<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
}
