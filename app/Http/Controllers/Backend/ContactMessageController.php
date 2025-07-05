<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseData;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class ContactMessageController extends Controller
{
    use ResponseData;

    public function index(Request $request){
        //authorized 403
        Gate::authorize('contact-message-access');

        if($request->ajax()){
            $getData = Contact::orderBy('created_at', 'desc');
            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if (!empty($request->search)) {
                        $searchTerm = '%' . $request->search . '%';
                        $query->where('email', 'LIKE', $searchTerm);
                    }
                })
                ->addColumn('name', function ($row) {
                    return "
                        <p class='mb-0'><b>".$row->first_name.' '.$row->last_name."</b> -
                        ".$row->phone_number."</p>
                    ";
                })
                ->addColumn('created_at', function ($row) {
                    return datetime_format($row->created_at);
                })
                ->addColumn('action', function ($row) {
                    $action = '<div class="d-flex align-items-center justify-content-end">';
                    if(permission('contact-message-reply')){
                    $action .= '<button type="button" class="btn-style btn-style-view reply_data ml-1" data-id="' . $row->id . '" data-name="' . $row->email . '"><i class="fa fa-reply fa-sm"></i></button>';
                    }
                    if(permission('contact-message-view')){
                    $action .= '<button type="button" class="btn-style btn-style-edit view_data ml-1" data-id="' . $row->id . '" data-email="' . $row->email . '"><i class="fa fa-eye fa-sm"></i></button>';
                    }
                    $action .= '</div>';
                    return $action;
                })
                ->rawColumns(['name','action'])
                ->make(true);
        }

        $this->setPageTitle('Contact List');
        $data['breadcrumb'] = ['Contact List' => ''];
        return view('backend.contact-message.index', $data);
    }

    public function details(Request $request){
        if($request->ajax()){
            $data = Contact::find($request->id);
            if($data){
                $viewData = view('backend.contact-message.view',compact('data'))->render();
                return $this->responseJson('success',null, $viewData);
            }else{
                return $this->responseJson('error',null, 'Data cannot view!');
            }
        }
    }
}
