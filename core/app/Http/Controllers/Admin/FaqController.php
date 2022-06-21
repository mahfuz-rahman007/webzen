<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use Session;
use App\Language;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function faq(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $faqs = Faq::where('language_id', $lang)->orderBy('id', 'DESC')->get();

        return view('admin.faq.index', compact('faqs'));
    }

    // Add Faq
    public function add_faq()
    {
        return view('admin.faq.add');
    }

    // Store Faq
    public function store_faq(Request $request)
    {

        $request->validate([
            'title' => 'required|max:150',
            'content' => 'required',
        ]);

        $faq = new Faq();
        $faq->language_id = $request->language_id;
        $faq->status = $request->status;
        $faq->title = $request->title;
        $faq->content = $request->content;
        $faq->save();

        $notification = array(
            'messege' => 'Faq Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // Faq Delete
    public function delete_faq($id)
    {

        $faq = Faq::find($id);
        $faq->delete();

        $notification = array(
            'messege' => 'Faq Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // Faq Edit
    public function edit_faq($id)
    {

        $faq = Faq::find($id);
        return view('admin.faq.edit', compact('faq'));

    }

    // Update Faq
    public function update_faq(Request $request, $id)
    {

        $id = $request->id;
         $request->validate([
            'title' => 'required|max:150',
            'content' => 'required',
        ]);

        $faq = Faq::find($id);
        
        $faq->language_id = $request->language_id;
        $faq->status = $request->status;
        $faq->title = $request->title;
        $faq->content = $request->content;
        $faq->save();

        $notification = array(
            'messege' => 'Faq Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.faq').'?language='.$this->lang->code)->with('notification', $notification);
    }



}
