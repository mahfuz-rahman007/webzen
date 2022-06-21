<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\Sectiontitle;
use App\Language;
use Session;

class PackagController extends Controller
{
   public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function package(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $packages = Package::where('language_id', $lang)->orderBy('id', 'DESC')->get();

        $sectiontitle = Sectiontitle::where('language_id', $lang)->first();

        return view('admin.package.index', compact('packages', 'sectiontitle'));
    }

    // Add slider Category
    public function add_package()
    {
        return view('admin.package.add');
    }

    // Store slider Category
    public function store_package(Request $request)
    {

        $request->validate([
            'name' => 'required|max:150',
            'language_id' => 'required',
            'time' => 'required|max:150',
            'feature' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|max:150',
        ]);

        Package::create($request->all());

        $notification = array(
            'messege' => 'Package Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // slider Category Delete
    public function delete_package($id)
    {

        $Package = Package::find($id);
        $Package->delete();

        $notification = array(
            'messege' => 'Package Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // slider Category Edit
    public function edit_package($id)
    {

        $package = Package::find($id);
        return view('admin.package.edit', compact('package'));

    }

    // Update slider Category
    public function update_package(Request $request, $id)
    {

        $id = $request->id;
        $request->validate([
            'name' => 'required|max:150',
            'language_id' => 'required',
            'time' => 'required|max:150',
            'feature' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|max:150',
        ]);

        $package = Package::find($id);
        $package->update($request->all());

        $lang = Language::where('id', $package->language_id)->first();
    
        $notification = array(
            'messege' => 'Package Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.package').'?language='.$lang->code)->with('notification', $notification);;
    }

    public function update_plancontent(Request $request, $id)
    {

        $request->validate([
            'plan_title' => 'required',
            'plan_subtitle' => 'required',
        ]);

        $lang = Language::findOrfail($id);

        $plan_title = Sectiontitle::where('language_id', $id)->first();


        $plan_title->plan_title = $request->plan_title;
        $plan_title->plan_subtitle = $request->plan_subtitle;
        $plan_title->save();


        $notification = array(
            'messege' => 'Pricing Plan Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.package').'?language='.$lang->code)->with('notification', $notification);
    }

}
