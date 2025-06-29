<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\ResponseData;
use App\Interfaces\UserInterface;
use App\Traits\UploadAble;
use Yajra\DataTables\Facades\DataTables;

class UserRepository implements UserInterface {

    use ResponseData, UploadAble;

    public function get($data){
        $getData = User::orderBy('created_at', 'desc');

        return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->filter(function ($query) use ($data) {
                if (!empty($data->search)) {
                    $searchTerm = '%' . $data->search . '%';
                    $query->where('name', 'LIKE', $searchTerm);
                }
            })
            ->addColumn('image', function ($row) {
                return table_image($row->image, $row->first_name);
            })
            ->addColumn('status', function ($row) {
                return change_status($row->id, $row->status, $row->title);
            })
            ->addColumn('created_at', function ($row) {
                return datetime_format($row->created_at);
            })
            ->addColumn('action', function ($row) {
                $action = '<div class="d-flex align-items-center justify-content-end">';
                $action .= '<a href="'.route('admin.users.edit',$row->id).'" type="button" class="btn-style btn-style-edit"><i class="fa fa-edit fa-sm"></i></a>';

                $action .= '<button type="button" class="btn-style btn-style-danger delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash fa-sm"></i></button>';
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['image','status', 'action'])
            ->make(true);
    }

    public function storeOrUpdate($data){
        $collection = collect($data->validated())->except('image','password_confirmation');
        $created_at = $updated_at = Carbon::now();
        $created_by = $updated_by = auth()->admin()->username;
        $image      = $data->old_image;
        $username   = generateUsername($data->first_name,$data->last_name,"users"); // username generate
        // new image upload and old image delete
        if($data->hasFile('image')){
            $image = $this->uploadFile($data->file('image'),USER_IMAGE_PATH);
            if($data->old_image){
                $this->deleteFile($data->old_image);
            }
        }

        if ($data->update_id) {
            $collection = $collection->merge(compact('updated_by','updated_at','image'));
        }else{
            $collection = $collection->merge(compact('created_by','created_at','username','image'));
        }

        try {
            $result = User::updateOrCreate(['id'=>$data->update_id],$collection->all());
            if($result){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $e) {
            return true;
        }
    }

    public function delete($id){
        $data = User::find($id);
        if($data){
            $this->deleteFile($data->image);
            $data->delete();
            return $this->responseJson('success','Category deleted successfull.');
        }else{
            return $this->responseJson('error','Category not found!');
        }
    }

    public function status($id, $status){
        $data = User::find($id);
        if($data){
            $data->update(['status'=>$status]);
            return $this->responseJson('success','Admin status updated successfull.');
        }else{
            return $this->responseJson('error','Admin not found!');
        }
    }

}
