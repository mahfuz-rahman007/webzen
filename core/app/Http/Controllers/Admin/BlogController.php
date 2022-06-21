<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Blog;
use App\Language;
use App\Bcategory;
use App\Sectiontitle;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default', 1)->first();
    }

    public function blog(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $blogs = Blog::where('language_id', $lang)->orderBy('id', 'DESC')->get();

        $sectiontitle = Sectiontitle::where('language_id', $lang)->first();

        return view('admin.blog.index', compact('blogs', 'sectiontitle'));
    }

    // Add Blog
    public function add_blog()
    {
        return view('admin.blog.add');
    }

    public function blog_get_category($id)
    {

        $bcategories = Bcategory::where('status', 1)->where('language_id', $id)->get();
        $output = '';

        foreach($bcategories as $bcategory){
            $output .= '<option value="'.$bcategory->id.'">'.$bcategory->name.'</option>';
        }
        return $output;
    }

    // Store Blog
    public function store_blog(Request $request)
    {

        $slug = Helper::make_slug($request->title);
        $blogs = Blog::select('slug')->get();


        $request->validate([
            'main_image' => 'required|mimes:jpeg,jpg,png',
            'title' => [
                'required',
                'unique:blogs,title',
                'max:255',
                function($attribute, $value, $fail) use ($slug, $blogs){
                    foreach($blogs as $blog){
                        if($blog->slug == $slug){
                            return $fail('Title already taken!');
                        }
                    }
                }
            ],
            'status' => 'required',
            'content' => 'required',
            'bcategory_id' => 'required',
            'language_id' => 'required',
        ]);


        $blog = new Blog();

        if($request->hasFile('main_image')){

            $file = $request->file('main_image');
            $extension = $file->getClientOriginalExtension();
            $main_image = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $main_image);

            $blog->main_image = $main_image;
        }


        $blog->title = $request->title;
        $blog->language_id = $request->language_id;
        $blog->status = $request->status;
        $blog->content = Purifier::clean($request->content);
        $blog->slug = $slug;
        $blog->bcategory_id = $request->bcategory_id;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_description = $request->meta_description;
        $blog->save();

        $notification = array(
            'messege' => 'Blog Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }

    // Blog  Delete
    public function delete_blog($id)
    {

        $blog = Blog::find($id);
        @unlink('assets/front/img/'. $blog->main_image);
        $blog->delete();

        $notification = array(
            'messege' => 'Blog Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // Blog  Edit
    public function edit_blog($id)
    {

        $blog = Blog::findOrFail($id);
        $blog_lan = $blog->language_id;

        $bcategories = Bcategory::where('status', 1)->where('language_id', $blog_lan)->get();

        return view('admin.blog.edit', compact('bcategories', 'blog'));

    }

    // Blog Update
    public function update_blog(Request $request, $id)
    {

        $slug = Helper::make_slug($request->title);
        $blogs = Blog::select('slug')->get();
        $blog = Blog::findOrFail($id);

        $request->validate([
            'main_image' => 'mimes:jpeg,jpg,png',
            'title' => [
                'required',
                'max:255',
                function($attribute, $value, $fail) use ($slug, $blogs, $blog){
                    foreach($blogs as $blg){
                        if($blog->slug != $slug){
                            if($blg->slug == $slug){
                                return $fail('Title already taken!');
                            }
                        }
                    }
                },
                'unique:blogs,title,'.$id
            ],
            'status' => 'required',
            'content' => 'required',
            'bcategory_id' => 'required',
            'language_id' => 'required',

        ]);


        if($request->hasFile('main_image')){
            @unlink('assets/front/img/'. $blog->main_image);

            $file = $request->file('main_image');
            $extension = $file->getClientOriginalExtension();
            $main_image = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $main_image);

            $blog->main_image = $main_image;

        }

        $blog->title = $request->title;
        $blog->language_id = $request->language_id;
        $blog->status = $request->status;
        $blog->content = Purifier::clean($request->content);
        $blog->slug = $slug;
        $blog->bcategory_id = $request->bcategory_id;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_description = $request->meta_description;

        $blog->save();

        $notification = array(
            'messege' => 'Blog Updated successfully!',
            'alert' => 'success'
        );

        return redirect(route('admin.blog').'?language='.$request->language)->with('notification', $notification);

    }

    public function update_blogcontent(Request $request, $id)
    {

        $request->validate([
            'blog_title' => 'required',
            'blog_subtitle' => 'required'
        ]);
        $lang = Language::findOrFail($id);

        $blog_title = Sectiontitle::where('language_id', $id)->first();


        $blog_title->blog_title = $request->blog_title;
        $blog_title->blog_subtitle = $request->blog_subtitle;
        $blog_title->save();

        $notification = array(
            'messege' => 'Blog Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.blog').'?language='.$lang->code)->with('notification', $notification);
    }
}
