<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Constants\GlobalConst;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pages;

class PagesController extends Controller
{
    public function index()
    {
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Pages' => ''];
        $type = Str::slug(GlobalConst::PAGE);
        $pages = Pages::where('type', $type)->get();
        return view('admin.sections.pages.index',compact(
            'breadcrumb',
            'pages',
        ));
    }


    public function statusUpdate(Request $request)
    {
        $request->validate([
            'target' => 'required|exists:pages,id',
            'status'  => 'required|boolean',
        ]);

        $pages = Pages::find($request->target);
        $pages->status = $request->status;
        $pages->save();

        return response()->json([
            'message' => 'User status updated successfully.',
            'status'  => $pages->status,
        ]);
    }
}
