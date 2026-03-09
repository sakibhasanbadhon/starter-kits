<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemMaintenanceController extends Controller
{
    public function index()
    {
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'System Maintenance' => ''];
        $this->setPageTitle('System Maintenance');
        $systemMaintenance = \App\Models\Admin\SystemMaintenance::first();
        return view('admin.sections.system-maintenance.index', compact('breadcrumb', 'systemMaintenance'));
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'title' => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $data['title'] = $request->title;
        $data['details'] = $request->details;
        $data['status'] = $request->status;

        try {
            \App\Models\Admin\SystemMaintenance::updateOrCreate(['id' => 1], $data);
        } catch (\Exception $e) {
            return back()->with(['error' => [__('Something went wrong. Please try again')]]);
        }

        return back()->with(['success' => [__('System maintenance settings updated successfully').'!']]);
    }
}
