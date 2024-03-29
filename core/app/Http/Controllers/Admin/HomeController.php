<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Language;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    public function home(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;
        $home = Setting::where('language_id', $lang)->first();
        return view('admin.home.home', compact('home'));
    }


    public function update_home(Request $request)
    {
        $request->validate([
            "herosection_bg" => "mimes:jpg,jpeg,png",
            'homearea_name' => 'required|max:30',
            'homearea_text' => 'required|max:250'
        ]);
        $lang = Language::where('code', $request->language)->first()->id;
        $home = Setting::where('language_id', $lang)->first();

        $setting  = Setting::first();
        if($request->hasFile('herosection_bg')){

            @unlink('assets/front/img/herosection_bg');

            $file = $request->file('herosection_bg');
            $extension = $file->getClientOriginalExtension();
            $herosection_bg = 'herosection_bg' . '.' . $extension;
            $file->move('assets/front/img/', $herosection_bg);

        }

        $setting->save();

        $home->homearea_name = $request->homearea_name;
        $home->homearea_text = $request->homearea_text;
        $home->save();

        $notification = array(
            'messege' => 'Home Section Successfully',
            'alert'   => 'success'
        );

        return redirect()->back()->with('notification', $notification);
    }


}
