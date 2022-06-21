<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use App\Dynamicpage;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;

class DynamicpageController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function dynamic_page(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $dynamicpages = Dynamicpage::where('language_id', $lang)->orderBy('id', 'DESC')->get();



        return view('admin.dynamicpage.index', compact('dynamicpages'));
    }

    public function add()
    {
        return view('admin.dynamicpage.add');
    }

    public function store(Request $request)
    {

        $slug = Helper::make_slug($request->title);
        $dynamicpages = Dynamicpage::select('slug')->get();

        $request->validate([
            'title' => [
                'required',
                'unique:dynamicpages,title',
                'max:255',
                function($attribute, $value, $fail) use ($slug, $dynamicpages){
                    foreach($dynamicpages as $dynamicpage){
                        if($dynamicpage->slug == $slug){
                            return $fail('Title already taken!');
                        }
                    }
                }
            ],
            'content' => 'required',
        ]);

        $dynamicpage = new Dynamicpage();
        $dynamicpage->language_id = $request->language_id;
        $dynamicpage->title = $request->title;
        $dynamicpage->slug = $slug;
        $dynamicpage->content = Purifier::clean($request->content);
        $dynamicpage->status = $request->status;
        $dynamicpage->save();

        $notification = array(
            'messege' => 'Dynamic Page Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function edit($id)
    {

        $dynamicpage = Dynamicpage::find($id);
        return view('admin.dynamicpage.edit', compact('dynamicpage'));

    }

    public function update(Request $request, $id)
    {

        $slug = Helper::make_slug($request->title);
        $dynamicpages = Dynamicpage::select('slug')->get();
        $dynamicpage = Dynamicpage::findOrFail($id);

         $request->validate([
            'title' => [
                'required',
                'max:255',
                function($attribute, $value, $fail) use ($slug, $dynamicpages, $dynamicpage){
                    foreach($dynamicpages as $blg){
                        if($dynamicpage->slug != $slug){
                            if($blg->slug == $slug){
                                return $fail('Title already taken!');
                            }
                        }
                    }
                },
                'unique:dynamicpages,title,'.$id
            ],
            'content' => 'required',
        ]);

        $dynamicpage->language_id = $request->language_id;
        $dynamicpage->title = $request->title;
        $dynamicpage->slug = $slug;
        $dynamicpage->content = Purifier::clean($request->content);
        $dynamicpage->status = $request->status;

        $dynamicpage->save();

        $notification = array(
            'messege' => 'Dynamic Page Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.dynamic_page').'?language='.$request->language)->with('notification', $notification);
    }

    public function delete($id)
    {

        $dynamicpage = Dynamicpage::find($id);
        $dynamicpage->delete();

        $notification = array(
            'messege' => 'Dynamic Page Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }


}
