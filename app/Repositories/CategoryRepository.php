<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\Admin\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CategoryInterface;
use Yajra\DataTables\Facades\DataTables;

class CategoryRepository implements CategoryInterface {

    public function get($data){
        $getData = Category::orderBy('created_at', 'desc');
        return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->filter(function ($query) use ($data) {
                if (!empty($data->search)) {
                    $searchTerm = '%' . $data->search . '%';
                    $query->where('name', 'LIKE', $searchTerm);
                }
            })
            ->addColumn('status', function ($row) {
                return change_status($row->id, $row->status, $row->title);
            })
            ->addColumn('created_at', function ($row) {
                return datetime_format($row->created_at);
            })

            ->addColumn('action', function ($row) {
                $action = '<div class="d-flex align-items-center justify-content-end">';
                $action .= '<button type="button" class="btn-style btn-style-danger delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->role_name . '"><i class="fa fa-trash fa-sm"></i></button>';
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function storeOrUpdate($data){
        $collection = collect($data->validated())->except('permissions');
        $slug       = Str::slug($data->name);
        $created_at = $updated_at = Carbon::now();
        $created_by = $updated_by = auth()->user()->name;
        if ($data->update_id) {
            $users = User::where('role_id',$data->update_id)->pluck('id')->toArray();
            DB::table('sessions')->whereIn('user_id', $users)->delete();
            $collection = $collection->merge(compact('updated_by','updated_at','slug'));
        }else{
            $collection = $collection->merge(compact('created_by','created_at','slug'));
        }

        $result = Role::updateOrCreate(['id'=>$data->update_id],$collection->all());
        if($result){
            $result->permissions()->sync($data->permission);
            return true;
        }else{
            return false;
        }
    }

}
