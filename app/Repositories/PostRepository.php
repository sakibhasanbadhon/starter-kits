<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Post;
use App\Traits\UploadAble;
use Illuminate\Support\Str;
use App\Traits\ResponseData;
use App\Interfaces\PostInterface;
use Yajra\DataTables\Facades\DataTables;

class PostRepository implements PostInterface {

    use ResponseData, UploadAble;

    public function get($data){
        $getData = Post::with('category')->orderBy('created_at', 'desc');
        return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->filter(function ($query) use ($data) {
                if (!empty($data->search)) {
                    $searchTerm = '%' . $data->search . '%';
                    $query->where('name', 'LIKE', $searchTerm);
                }
            })
            ->addColumn('category', function ($row) {
                return $row->category->name;
            })
            ->addColumn('feature_image', function ($row) {
                return table_image($row->featured_image, $row->title);
            })
            ->addColumn('is_featured', function ($row) {
                return IS_FEATURED_LABEL[$row->is_featured];
            })
            ->addColumn('status', function ($row) {
                if(permission('post-status')){
                    return change_status($row->id, $row->status, $row->title);
                }else{
                    return POST_STATUS_LABEL[$row->status];
                }
            })
            ->addColumn('created_at', function ($row) {
                return datetime_format($row->created_at);
            })
            ->addColumn('action', function ($row) {
                $action = '<div class="d-flex align-items-center justify-content-end">';
                if(permission('post-edit')){
                $action .= '<a href="'.route('admin.posts.edit', $row->id).'" class="btn-style btn-style-edit" ><i class="fa fa-edit fa-sm"></i></a>';
                }

                if(permission('post-delete')){
                $action .= '<button type="button" class="btn-style btn-style-danger delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash fa-sm"></i></button>';
                }
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['is_featured','feature_image','status', 'action'])
            ->make(true);
    }

    public function storeOrUpdate($data){
        $collection    = collect($data->validated())->except('feature_image');
        $created_at    = $updated_at = Carbon::now();
        $created_by    = $updated_by = auth()->admin()->username;
        $user_id       = auth()->admin()->id;
        $slug          = Str::slug($data->title);
        $featured_image = $data->old_feature_image;
        // new image upload and old image delete
        if($data->hasFile('feature_image')){
            $featured_image = $this->uploadFile($data->file('feature_image'),POST_IMAGE_PATH);
            if($data->old_feature_image){
                $this->deleteFile($data->old_feature_image);
            }
        }

        if ($data->update_id) {
            $collection = $collection->merge(compact('updated_by','updated_at','featured_image','slug','user_id'));
        }else{
            $collection = $collection->merge(compact('created_by','created_at','featured_image','slug','user_id'));
        }

        try {
            $result = Post::updateOrCreate(['id'=>$data->update_id],$collection->all());
            if($result){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id){
        $data = Post::find($id);
        if($data){
            $this->deleteFile($data->featured_image);
            $data->delete();
            return $this->responseJson('success','Post deleted successfull.');
        }else{
            return $this->responseJson('error','Post not found!');
        }
    }

    public function status($id, $status){
        $data = Post::find($id);
        if($data){
            $data->update(['status'=>$status]);
            return $this->responseJson('success','Post status updated successfull.');
        }else{
            return $this->responseJson('error','Post not found!');
        }
    }

}
