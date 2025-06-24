<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\Role;
use Illuminate\Support\Str;
use App\Interfaces\RoleInterface;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleInterface {

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
