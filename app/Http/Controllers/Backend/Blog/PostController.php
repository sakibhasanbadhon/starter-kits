<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Traits\ResponseData;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    use ResponseData;

    protected $post;

    public function __construct(PostService $postService)
    {
        $this->post = $postService;
    }

    public function index(Request $request){
        if($request->ajax()){
            return $this->post->allData($request);
        }

        $this->setPageTitle('Post List');
        $data['breadcrumb'] = ['Post List' => ''];
        return view('backend.blog.index', $data);
    }

    public function create(){
        $data['categories'] = Category::status(1)->latest()->pluck('name','id');

        $this->setPageTitle('New Post');
        $data['breadcrumb'] = ['Post List'=>route('admin.posts.index'),'New Post' => ''];
        return view('backend.blog.store-or-update', $data);
    }

    public function storeOrUpdate(PostRequest $request){
        if($request->ajax()){
            $result = $this->post->storeOrUpdateData($request);
            if($result){
                if($request->update_id){
                    return redirect()->route('admin.posts.index')->with('success','Post updated successfull.');
                }else{
                    return redirect()->route('admin.posts.index')->with('success','Post saved successfull.');
                }
            }else{
                return redirect()->back()->with('error','Post cannot be created!');
            }
        }
    }

    public function edit(int $id){
        $data['edit']  = Post::findOrFail($id);
        $data['categories'] = Category::status(1)->latest()->pluck('name','id');

        $this->setPageTitle('New Post');
        $data['breadcrumb'] = ['Post List'=>route('admin.posts.index'),'New Post' => ''];
        return view('backend.blog.store-or-update', $data);
    }

    public function delete(Request $request){
        if($request->ajax()){
            return $this->post->deleteData($request->id);
        }
    }

    public function statusChange(Request $request){
        if($request->ajax()){
            return $this->post->statusData($request->id, $request->status);
        }
    }
}
