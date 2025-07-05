<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\FAQ;
use App\Traits\ResponseData;
use App\Interfaces\FAQInterface;
use Yajra\DataTables\Facades\DataTables;

class FAQRepository implements FAQInterface {

    use ResponseData;

    public function get($data){
        $getData = FAQ::orderBy('created_at', 'desc');

        return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->filter(function ($query) use ($data) {
                if (!empty($data->search)) {
                    $searchTerm = '%' . $data->search . '%';
                    $query->where('question', 'LIKE', $searchTerm);
                }
            })
            ->addColumn('status', function ($row) {
                if(permission('faq-status')){
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
                if(permission('faq-edit')){
                $action .= '<a href="'.route('admin.faqs.edit',$row->id).'" type="button" class="btn-style btn-style-edit"><i class="fa fa-edit fa-sm"></i></a>';
                }

                if(permission('faq-delete')){
                $action .= '<button type="button" class="btn-style btn-style-danger delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash fa-sm"></i></button>';
                }
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function storeOrUpdate($data){
        $collection = collect($data->validated())->except('image');
        $created_at = $updated_at = Carbon::now();
        $created_by = $updated_by = auth()->admin()->username;
        if ($data->update_id) {
            $collection = $collection->merge(compact('updated_by','updated_at'));
        }else{
            $collection = $collection->merge(compact('created_by','created_at'));
        }

        try {
            $result = FAQ::updateOrCreate(['id'=>$data->update_id],$collection->all());
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
        $data = FAQ::find($id);
        if($data){
            $data->delete();
            return $this->responseJson('success','FAQ deleted successfull.');
        }else{
            return $this->responseJson('error','FAQ not found!');
        }
    }

    public function status($id, $status){
        $data = FAQ::find($id);
        if($data){
            $data->update(['status'=>$status]);
            return $this->responseJson('success','FAQ status updated successfull.');
        }else{
            return $this->responseJson('error','FAQ not found!');
        }
    }

}
