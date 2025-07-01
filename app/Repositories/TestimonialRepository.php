<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Testimonial;
use App\Traits\ResponseData;
use App\Interfaces\TestimonialInterface;
use App\Traits\UploadAble;
use Yajra\DataTables\Facades\DataTables;

class TestimonialRepository implements TestimonialInterface {

    use ResponseData, UploadAble;

    public function get($data){
        $getData = Testimonial::orderBy('created_at', 'desc');

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
                if(permission('testimonial-status')){
                    return change_status($row->id, $row->status, $row->title);
                }else{
                    return STATUS_LABEL[$row->status];
                }
            })
            ->addColumn('created_at', function ($row) {
                return datetime_format($row->created_at);
            })
            ->addColumn('action', function ($row) {
                $action = '<div class="d-flex align-items-center justify-content-end">';
                if(permission('testimonial-edit')){
                $action .= '<a href="'.route('admin.testimonials.edit',$row->id).'" type="button" class="btn-style btn-style-edit"><i class="fa fa-edit fa-sm"></i></a>';
                }

                if(permission('testimonial-delete')){
                $action .= '<button type="button" class="btn-style btn-style-danger delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash fa-sm"></i></button>';
                }
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['image','status', 'action'])
            ->make(true);
    }

    public function storeOrUpdate($data){
        $collection = collect($data->validated())->except('image');
        $created_at = $updated_at = Carbon::now();
        $created_by = $updated_by = auth()->admin()->username;
        $image      = $data->old_image;
        // new image upload and old image delete
        if($data->hasFile('image')){
            $image = $this->uploadFile($data->file('image'),TESTIMONIAL_IMAGE_PATH);
            if($data->old_image){
                $this->deleteFile($data->old_image);
            }
        }

        if ($data->update_id) {
            $collection = $collection->merge(compact('updated_by','updated_at','image'));
        }else{
            $collection = $collection->merge(compact('created_by','created_at','image'));
        }

        try {
            $result = Testimonial::updateOrCreate(['id'=>$data->update_id],$collection->all());
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
        $data = Testimonial::find($id);
        if($data){
            $this->deleteFile($data->image);
            $data->delete();
            return $this->responseJson('success','Testimonial deleted successfull.');
        }else{
            return $this->responseJson('error','Testimonial not found!');
        }
    }

    public function status($id, $status){
        $data = Testimonial::find($id);
        if($data){
            $data->update(['status'=>$status]);
            return $this->responseJson('success','Testimonial status updated successfull.');
        }else{
            return $this->responseJson('error','Testimonial not found!');
        }
    }

}
