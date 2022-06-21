<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Service;
use App\Language;
use App\Sectiontitle;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class ServiceController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function service(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $services = Service::where('language_id', $lang)->orderBy('id', 'DESC')->get();

        $sectiontitle = Sectiontitle::where('language_id', $lang)->first();
        return view('admin.service.index', compact('services', 'sectiontitle'));
    }

    // Add Service
    public function add_service()
    {
        return view('admin.service.add');
    }

    // Store Service
    public function store_service(Request $request)
    {

        $slug = Helper::make_slug($request->name);
        $services = Service::select('slug')->get();

        $request->validate([
            'name' => [
              'required',
              'unique:services,name',
              'max:150',
              function($attribute, $value, $fail) use ($slug, $services) {
                  foreach($services as $service) {
                    if ($service->slug == $slug) {
                      return $fail('Name already taken!');
                    }
                  }
                }
            ],
            'icon' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
            'content' => 'required'
        ]);

        $service = new Service();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);

            $service->image = $image;
        }


        $service->name = $request->name;
        $service->slug = $slug;
        $service->content = $request->content;
        $service->language_id = $request->language_id;
        $service->icon = $request->icon;
        $service->status = $request->status;
        $service->save();

        $notification = array(
            'messege' => 'Service Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // Service Delete
    public function delete_service($id)
    {

        $service = Service::find($id);
        @unlink('assets/front/img/'. $service->image);
        $service->delete();

        $notification = array(
            'messege' => 'Service Content Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // Service Edit
    public function edit_service($id)
    {

        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));

    }

    // Update Service
    public function update_service(Request $request, $id)
    {

        $slug = Helper::make_slug($request->name);
        $services = Service::select('slug')->get();
        $service = Service::findOrFail($id);

         $request->validate([
            'name' => [
              'required',
              'max:150',
              function($attribute, $value, $fail) use ($slug, $services, $service) {
                  foreach($services as $serv) {
                    if ($service->slug != $slug) {
                      if ($serv->slug == $slug) {
                        return $fail('Title already taken!');
                      }
                    }
                  }
                },
                'unique:services,name,'.$id
            ],
            'icon' => 'required',
            'content' => 'required'
        ]);

        if($request->hasFile('image')){
            @unlink('assets/front/img/'. $service->image);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);

            $service->image = $image;
        }

        $service->name = $request->name;
        $service->slug = $slug;
        $service->content =$request->content;
        $service->language_id = $request->language_id;
        $service->icon = $request->icon;
        $service->status = $request->status;
        $service->save();

        $notification = array(
            'messege' => 'Service Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.service').'?language='.$request->language)->with('notification', $notification);
    }

    public function update_servicecontent(Request $request, $id)
    {

        $request->validate([
            'service_title' => 'required',
            'service_subtitle' => 'required',
        ]);
        $lang = Language::findOrFail($id);
        $service_title = Sectiontitle::where('language_id', $id)->first();

        $service_title->update($request->all());

        $notification = array(
            'messege' => 'Service Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.service').'?language='.$lang->code)->with('notification', $notification);
    }
}
