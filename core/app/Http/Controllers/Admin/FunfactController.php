<?php

namespace App\Http\Controllers\Admin;

use App\Funfact;
use App\Language;
use App\Sectiontitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FunfactController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function funfact(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $funfacts = Funfact::where('language_id', $lang)->orderBy('id', 'DESC')->get();
        $sectiontitle = Sectiontitle::where('language_id', $lang)->first();

        return view('admin.funfact.index', compact('funfacts', 'sectiontitle'));
    }

    public function add_funfact()
    {
        return view('admin.funfact.add');
    }

    public function store_funfact(Request $request)
    {


        $request->validate([
            'icon' => 'required',
            'name' => 'required|max:255',
            'value' => 'required',
        ]);

        $funfact = new Funfact();

        $funfact->language_id = $request->language_id;
        $funfact->name = $request->name;
        $funfact->value = $request->value;
        $funfact->icon = $request->icon;
        $funfact->save();

        $notification = array(
            'messege' => 'Funfact Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function edit_funfact($id)
    {

        $funfact = Funfact::find($id);
        return view('admin.funfact.edit', compact('funfact'));

    }

    public function update_funfact(Request $request, $id)
    {

        $funfact = Funfact::findOrFail($id);

         $request->validate([
            'icon' => 'required',
            'name' => 'required|max:255',
            'value' => 'required',
        ]);

        $funfact->language_id = $request->language_id;
        $funfact->name = $request->name;
        $funfact->value = $request->value;
        $funfact->icon = $request->icon;

        $funfact->save();

        $notification = array(
            'messege' => 'Funfact Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.funfact').'?language='.$request->language)->with('notification', $notification);
    }

    public function delete_funfact($id)
    {

        $funfact = Funfact::find($id);
        $funfact->delete();

        $notification = array(
            'messege' => 'Funfact Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function update_funfactcontent(Request $request, $id)
    {

        $request->validate([
            'funfact_bg' => 'mimes:jpeg,jpg,png',
        ]);

        $lang = Language::findOrFail($id);

        $funfact_title = Sectiontitle::where('language_id', $id)->first();

        if($request->hasFile('funfact_bg')){
            @unlink('assets/front/img/'. $funfact_title->funfact_bg);
            $file = $request->file('funfact_bg');
            $extension = $file->getClientOriginalExtension();
            $funfact_bg = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $funfact_bg);

            $funfact_title->funfact_bg = $funfact_bg;
        }

        $funfact_title->save();

        $notification = array(
            'messege' => 'Funfact Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.funfact').'?language='.$lang->code)->with('notification', $notification);
    }

}
