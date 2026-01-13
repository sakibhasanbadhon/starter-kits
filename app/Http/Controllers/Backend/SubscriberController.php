<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseData;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class SubscriberController extends Controller
{
    use ResponseData;

    public function index(Request $request){
        //authorized 403
        Gate::authorize('subscriber-access');

        if($request->ajax()){
            $getData = Subscriber::orderBy('created_at', 'desc');
            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if (!empty($request->search)) {
                        $searchTerm = '%' . $request->search . '%';
                        $query->where('email', 'LIKE', $searchTerm);
                    }
                })
                ->addColumn('created_at', function ($row) {
                    return datetime_format($row->created_at);
                })
                ->addColumn('action', function ($row) {
                    $action = '<div class="d-flex align-items-center justify-content-end">';
                    if(permission('subscriber-delete')){
                    $action .= '<button type="button" class="btn-style btn-style-danger delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash fa-sm"></i></button>';
                    }
                    $action .= '</div>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $this->setPageTitle('Subscriber List');
        $data['breadcrumb'] = ['Subscriber List' => ''];
        return view('backend.subscriber.index', $data);
    }

    public function delete(Request $request){
        if($request->ajax()){
            if(permission('subscriber-delete')){
                $result = Subscriber::find($request->id);
                if($result){
                    $result->delete();
                    return $this->responseJson('success','Email deleted successfull.');
                }else{
                    return $this->responseJson('error', 'Email cannot deleted successfull.');
                }
            }else{
                    return $this->responseJson('error', UNAUTHORIZED_MSG);
            }
        }
    }
}
