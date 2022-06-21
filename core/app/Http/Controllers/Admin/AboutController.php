<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\About;
use App\Language;
use App\Sectiontitle;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function about(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $abouts = About::where('language_id', $lang)->orderBy('id', 'DESC')->get();

        $sectiontitle = Sectiontitle::where('language_id', $lang)->first();

        return view('admin.about.index', compact('abouts', 'sectiontitle'));
    }

    // Add slider Category
    public function add_about()
    {
        return view('admin.about.add');
    }

    // Store slider Category
    public function store_about(Request $request)
    {

        $request->validate([
            'feature' => 'required|max:150',
        ]);

        About::create($request->all());

        $notification = array(
            'messege' => 'About Feature Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // slider Category Delete
    public function delete_about($id)
    {

        $about = About::find($id);
        $about->delete();

        $notification = array(
            'messege' => 'About Feature Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // slider Category Edit
    public function edit_about($id)
    {

        $about = About::find($id);
        return view('admin.about.edit', compact('about'));

    }

    // Update slider Category
    public function update_about(Request $request, $id)
    {

        $id = $request->id;
        $request->validate([
            'feature' => 'required|max:150',
        ]);

        $about = About::find($id);
        $about->update($request->all());

        $notification = array(
            'messege' => 'About Feature Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.about').'?language='.$this->lang->code)->with('notification', $notification);
    }

    public function update_aboutcontent(Request $request, $id)
    {

        $request->validate([
            'about_title' => 'required',
            'about_subtitle' => 'required',
            'about_description' => 'required',
            'about_image_text' => 'required',
            'about_image' => 'mimes:jpeg,jpg,png',
        ]);
        $about_title = Sectiontitle::where('language_id', $id)->first();

         if($request->hasFile('about_image')){
            @unlink('assets/front/img/'. $about_title->about_image);
            $file = $request->file('about_image');
            $extension = $file->getClientOriginalExtension();
            $about_image = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $about_image);

            $about_title->about_image = $about_image;
        }

        $about_title->about_title = $request->about_title;
        $about_title->about_subtitle = $request->about_subtitle;
        $about_title->about_description = $request->about_description;
        $about_title->about_image_text = $request->about_image_text;
        $about_title->save();

        $notification = array(
            'messege' => 'About Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.about').'?language='.$request->language)->with('notification', $notification);
    }
}
