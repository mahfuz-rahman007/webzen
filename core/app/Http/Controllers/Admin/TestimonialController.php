<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Language;
use App\Testimonial;
use App\Sectiontitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function testimonial(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $testimonials = Testimonial::where('language_id', $lang)->orderBy('id', 'DESC')->get();
        $sectiontitle = Sectiontitle::where('language_id', $lang)->first();

        return view('admin.testimonial.index', compact('testimonials', 'sectiontitle'));
    }

    //Add Testimonial
    public function add_testimonial()
    {
        return view('admin.testimonial.add');
    }

    // Store Testimonial
    public function store_testimonial(Request $request)
    {

        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png',
            'name' => 'required|max:100',
            'position' => 'required|max:100',
            'rating' => 'required',
            'message' => 'required|max:300',
        ]);

        $testimonial = new Testimonial();

        if($request->hasFile('image')){

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);

            $testimonial->image = $image;
        }

        $testimonial->name = $request->name;
        $testimonial->language_id = $request->language_id;
        $testimonial->position = $request->position;
        $testimonial->rating = $request->rating;
        $testimonial->message = $request->message;
        $testimonial->save();


        $notification = array(
            'messege' => 'Testimonial Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }

    //Testimonial Delete
    public function delete_testimonial($id)
    {

        $testimonial = Testimonial::find($id);
        @unlink('assets/front/img/'. $testimonial->featured_image);
        $testimonial->delete();

        $notification = array(
            'messege' => 'Testimonial Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }

    //Service Delete
    public function edit_testimonial($id)
    {

        $testimonial = Testimonial::find($id);
        return view('admin.testimonial.edit', compact('testimonial'));

    }

    // Testimonial Update
    public function update_testimonial(Request $request, $id)
    {

        $request->validate([
            'image' => 'mimes:jpeg,jpg,png',
            'name' => 'required|max:100',
            'position' => 'required|max:100',
            'rating' => 'required',
            'message' => 'required|max:300',
        ]);

        $testimonial = Testimonial::find($id);
        if($request->hasFile('image')){
            @unlink('assets/front/img/'. $testimonial->image);

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);

            $testimonial->image = $image;
        }
        $testimonial->name = $request->name;
        $testimonial->language_id = $request->language_id;
        $testimonial->position = $request->position;
        $testimonial->rating = $request->rating;
        $testimonial->message = $request->message;
        $testimonial->save();

        $notification = array(
            'messege' => 'Testimonial Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.testimonial').'?language='.$request->language)->with('notification', $notification);


    }

    public function update_testimonialcontent(Request $request, $id)
    {

        $request->validate([
            'testimonial_title' => 'required',
            'testimonial_subtitle' => 'required',
            'testimonial_bg' => 'mimes:jpeg,jpg,png',
        ]);

        $lang = Language::findOrFail($id);

        $testimonial_title = Sectiontitle::where('language_id', $id)->first();

        if($request->hasFile('testimonial_bg')){
            @unlink('assets/front/img/'. $testimonial_title->testimonial_bg);
            $file = $request->file('testimonial_bg');
            $extension = $file->getClientOriginalExtension();
            $testimonial_bg = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $testimonial_bg);

            $testimonial_title->testimonial_bg = $testimonial_bg;

        }

        $testimonial_title->testimonial_title = $request->testimonial_title;
        $testimonial_title->testimonial_subtitle = $request->testimonial_subtitle;
        $testimonial_title->save();

        $notification = array(
            'messege' => 'Testimonial Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.testimonial').'?language='.$lang->code)->with('notification', $notification);
    }
}
