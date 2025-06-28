<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Admin\Admin;
use App\Traits\ResponseData;
use App\Interfaces\AdminInterface;
use Yajra\DataTables\Facades\DataTables;

class AdminRepository implements AdminInterface {

    use ResponseData;

    public function get($data){
        $getData = Admin::orderBy('created_at', 'desc');
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
                $action .= '<a href="'.route('admin.admins.edit',$row->id).'" type="button" class="btn-style btn-style-edit"><i class="fa fa-edit fa-sm"></i></a>';

                $action .= '<button type="button" class="btn-style btn-style-danger delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash fa-sm"></i></button>';
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['image','status', 'action'])
            ->make(true);
    }

    public function storeOrUpdate($data){
        $collection = collect($data->validated());
        $created_at = $updated_at = Carbon::now();
        $created_by = $updated_by = auth()->admin()->username;
        if ($data->update_id) {
            $collection = $collection->merge(compact('updated_by','updated_at'));
        }else{
            $collection = $collection->merge(compact('created_by','created_at'));
        }

        try {
            Category::updateOrCreate(['id'=>$data->update_id],$collection->all());
            if($data->update_id){
                return $this->responseJson('success','Category updated successfull.');
            }else{
                return $this->responseJson('success','Category saved successfull.');
            }
        } catch (\Exception $e) {
            return $this->responseJson('error','Category cannot be saved.');
        }
    }

    public function edit($id){
        $data = Category::find($id);
        if($data){
            return $this->responseJson('success',null,$data);
        }else{
            return $this->responseJson('error','Category not found!');
        }
    }

    public function delete($id){
        $data = Category::find($id);
        if($data){
            $data->delete();
            return $this->responseJson('success','Category deleted successfull.');
        }else{
            return $this->responseJson('error','Category not found!');
        }
    }

    public function status($id, $status){
        $data = Category::find($id);
        if($data){
            $data->update(['status'=>$status]);
            return $this->responseJson('success','Category status updated successfull.');
        }else{
            return $this->responseJson('error','Category not found!');
        }
    }

}
