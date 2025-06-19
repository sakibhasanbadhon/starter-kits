<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Contact;
use App\Models\Admin\Subscriber;
use App\Models\Admin\WebSetting;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function subscriber() {
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Subscriber' => ''];
        $subscribers = Subscriber::paginate(10);
        return view('admin.sections.subscriber', compact('subscribers','breadcrumb'));
    }


    public function contactMessage() {
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Contact' => ''];
        $contacts = Contact::paginate(10);
        return view('admin.sections.contact', compact('contacts','breadcrumb'));
    }

    public function webSetting() {
        $websettiongs = WebSetting::first();
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'websettings' => ''];
        return view('admin.sections.websettings',compact('breadcrumb','websettiongs'));
    }


    public function webSettingStore(Request $request) {
        // dd($request->all());
        $websettiongs = WebSetting::first();
        $validatedData = $request->validate([
            'sitename'       => 'required|string|max:255',
            'siteurl'         => 'required|url',
            'metatitle'       => 'nullable|string|max:255',
            'metadescription' => 'nullable|string',
            'copyright_text'  => 'nullable|string|max:255',
            'primary_color'   => 'nullable|string|max:7',
        ]);

        if ($request->hasFile('image')) {
            $image = uploadLocalImage($request->image, 'admin-profile', $request->old_image);
            $image_path = uploadImage([$image['dev_path']], 'admin-profile', $request->old_image);
            deleteFile($image['dev_path']);
            $validatedData['logo'] = $image_path;
        }

        try {
            $websettiongs->update($validatedData);
            $message = ['Web settings saved successfully!'];
            return back()->with(['success' => $message]);
        } catch (\Throwable $th) {
            $message = ['Something went wrong!'];
            return back()->with(['error' => $message]);
        }



    }





}
