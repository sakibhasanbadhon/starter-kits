<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\Role;
use Illuminate\Support\Str;
use App\Traits\ResponseData;
use App\Interfaces\RoleInterface;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RoleRepository implements RoleInterface {

    use ResponseData;

    public function get($data){
        $getData = Role::withCount('permissions')->orderBy('created_at', 'desc');

        return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->filter(function ($query) use ($data) {
                if (!empty($data->search)) {
                    $searchTerm = '%' . $data->search . '%';
                    $query->where('name', 'LIKE', $searchTerm);
                }
            })
            ->addColumn('permissions', function ($row) {
                return '<span class="badge badge-sm badge-success py-1 px-2 fs-3">'.$row->permissions_count.'</span>';
            })
            ->addColumn('created_at', function ($row) {
                return datetime_format($row->created_at);
            })
            ->addColumn('action', function ($row) {
                $action = '<div class="d-flex align-items-center justify-content-end">';
                if(permission('role-edit')){
                $action .= '<a href="'.route('admin.roles.edit', $row->id).'" class="btn-style btn-style-edit"><i class="fa fa-edit fa-sm"></i></a>';
                }
                if(permission('role-delete')){
                    if ($row->delatable == true){
                        $action .= '<button type="button" class="btn-style btn-style-danger delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash fa-sm"></i></button>';
                    }
                }
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['permissions', 'action'])
            ->make(true);
    }

    public function storeOrUpdate($data){
        $collection = collect($data->validated())->except('permission');
        $slug       = Str::slug($data->name);
        $created_at = $updated_at = Carbon::now();
        $created_by = $updated_by = auth()->admin()->username;
        if ($data->update_id) {
            $users = Admin::where('role_id',$data->update_id)->pluck('id')->toArray();
            if(!empty($users)){
                DB::table('sessions')->whereIn('user_id', $users)->delete();
            }
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

    public function delete($id){
        $role = Role::find($id);
        if($role){
            $role->permissions()->delete();
            $role->delete();
            return $this->responseJson('success','Role deleted successfull.');
        }else{
            return $this->responseJson('error','Role not found.');
        }
    }

}
