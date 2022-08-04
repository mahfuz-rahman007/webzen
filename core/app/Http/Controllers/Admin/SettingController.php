<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Language;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SettingController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default', 1)->first();
    }

    public function basicinfo(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;
        $basicinfo = Setting::where('language_id', $lang)->first();
        $commonsetting = Setting::where('id', 1)->first();

        return view('admin.setting.basicinfo', compact('basicinfo', 'commonsetting'));
    }

    public function update_basicinfo(Request $request, $id)
    {
        $lang = Language::where('id', $id)->first();
        $request->validate([
            'website_title'  => 'required|max:255',
            'address'  => 'required|max:255'
        ]);

        $basicinfo = Setting::where('language_id', $id)->first();

        $basicinfo->website_title = $request->website_title;
        $basicinfo->address = $request->address;
        $basicinfo->save();


        $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.setting.basicinfo') . '?language=' . $lang->code)->with('notification', $notification);
    }

    public function update_commoninfo(Request $request)
    {

        $request->validate([
            'number' => 'required|max:250',
            'email' => 'required|max:250',
            'contactemail' => 'required|max:250',
            'base_color' => 'required',
            'header_logo' => 'mimes:jpeg,jpg,png',
            'fav_icon' => 'mimes:jpeg,jpg,png',
            'breadcrumb_image' => 'mimes:jpeg,jpg,png'
        ]);


        $commonsetting = Setting::where('id', 1)->first();

        if ($request->hasFile('header_logo')) {
            @unlink('assets/front/img/' . $commonsetting->header_logo);
            $file = $request->file('header_logo');
            $extension = $file->getClientOriginalExtension();
            $header_logo = 'header_logo_' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $header_logo);
            $commonsetting->header_logo = $header_logo;
        }

        if ($request->hasFile('fav_icon')) {
            @unlink('assets/front/img/' . $commonsetting->fav_icon);
            $file = $request->file('fav_icon');
            $extension = $file->getClientOriginalExtension();
            $fav_icon = 'fav_icon_' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $fav_icon);
            $commonsetting->fav_icon = $fav_icon;
        }

        if ($request->hasFile('breadcrumb_image')) {
            @unlink('assets/front/img/' . $commonsetting->breadcrumb_image);
            $file = $request->file('breadcrumb_image');
            $extension = $file->getClientOriginalExtension();
            $breadcrumb_image = 'breadcrumb_image_'. time(). '.' . $extension;
            $file->move('assets/front/img/', $breadcrumb_image);
            $commonsetting->breadcrumb_image = $breadcrumb_image;
        }

        $commonsetting->number = $request->number;
        $commonsetting->email = $request->email;
        $commonsetting->contactemail = $request->contactemail;

        $new_base_color = ltrim($request->base_color, '#');
        $commonsetting->base_color = $new_base_color;


        $commonsetting->save();

        $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.setting.basicinfo') . '?language=' . $this->lang->code)->with('notification', $notification);
    }

    public function seoinfo(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;
        $seoinfo = Setting::where('language_id', $lang)->first();

        return view('admin.setting.seoinfo', compact('seoinfo'));
    }

    public function update_seoinfo(Request $request, $id)
    {

        $request->validate([
            'meta_keywords' => 'required',
            'meta_description' => 'required'
        ]);

        $lang = Language::where('id', $id)->first();
        $seo = Setting::where('language_id', $id)->first();

        $seo->meta_keywords = $request->meta_keywords;
        $seo->meta_description = $request->meta_description;
        $seo->save();

        $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.seoinfo') . '?language=' . $lang->code)->with('notification', $notification);
    }

    public function scripts()
    {
        $scripts = Setting::where('id', '1')->first();

        return view('admin.setting.scripts', compact('scripts'));
    }

    public function update_script(Request $request)
    {

        $scripts = Setting::where('id', '1')->first();

        $scripts->tawk_to = $request->tawk_to;
        $scripts->disqus  = $request->disqus;

        if ($request->is_tawk_to == 'on') {
            $scripts->is_tawk_to = 1;
        } else {
            $scripts->is_tawk_to = 0;
        }
        if ($request->is_disqus == 'on') {
            $scripts->is_disqus = 1;
        } else {
            $scripts->is_disqus = 0;
        }

        $scripts->save();

        $notification = array(
            'messege' => 'Scripts Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.scripts'))->with('notification', $notification);
    }

    public function pagevisibility()
    {

        return view('admin.setting.page-visibility');
    }

    public function update_pagevisibility(Request $request)
    {

        $pagevisibility = Setting::where('id', '1')->first();

        if ($request->is_about_section == 'on') {
            $pagevisibility->is_about_section = 1;
        } else {
            $pagevisibility->is_about_section = 0;
        }

        if ($request->is_team_section == 'on') {
            $pagevisibility->is_team_section = 1;
        } else {
            $pagevisibility->is_team_section = 0;
        }

        if ($request->is_service_section == 'on') {
            $pagevisibility->is_service_section = 1;
        } else {
            $pagevisibility->is_service_section = 0;
        }

        if ($request->is_testimonial_section == 'on') {
            $pagevisibility->is_testimonial_section = 1;
        } else {
            $pagevisibility->is_testimonial_section = 0;
        }

        if ($request->is_client_section == 'on') {
            $pagevisibility->is_client_section = 1;
        } else {
            $pagevisibility->is_client_section = 0;
        }

        if ($request->is_about_page == 'on') {
            $pagevisibility->is_about_page = 1;
        } else {
            $pagevisibility->is_about_page = 0;
        }

        if ($request->is_service_page == 'on') {
            $pagevisibility->is_service_page = 1;
        } else {
            $pagevisibility->is_service_page = 0;
        }


        if ($request->is_blog_page == 'on') {
            $pagevisibility->is_blog_page = 1;
        } else {
            $pagevisibility->is_blog_page = 0;
        }

        if ($request->is_contact_page == 'on') {
            $pagevisibility->is_contact_page = 1;
        } else {
            $pagevisibility->is_contact_page = 0;
        }


        if ($request->is_blog_share_links == 'on') {
            $pagevisibility->is_blog_share_links = 1;
        } else {
            $pagevisibility->is_blog_share_links = 0;
        }

        if ($request->is_cooki_alert == 'on') {
            $pagevisibility->is_cooki_alert = 1;
        } else {
            $pagevisibility->is_cooki_alert = 0;
        }


        $pagevisibility->save();

        $notification = array(
            'messege' => 'Page Visibility Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.pagevisibility'))->with('notification', $notification);
    }

    public function cookiealert(Request $request)
    {

        $lang = Language::where('code', $request->language)->first()->id;
        $cookiealert = Setting::where('language_id', $lang)->first();

        return view('admin.setting.cookie-alert', compact('cookiealert'));
    }

    public function update_cookiealert(Request $request, $id)
    {

        $request->validate([
            'cookie_alert_text' => 'required'
        ]);


        $lang = Language::where('id', $id)->first();
        $cookiealert = Setting::where('language_id', $id)->first();

        $cookiealert->cookie_alert_text = $request->cookie_alert_text;
        $cookiealert->save();

        $notification = array(
            'messege' => 'Cookie Alert Text Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.cookiealert') . '?language=' . $lang->code)->with('notification', $notification);
    }

    public function customcss()
    {
        $custom_css = '/* Write Custom Css Here */';

        if (file_exists('assets/front/css/dynamic-css.css')) {
            $custom_css = file_get_contents('assets/front/css/dynamic-css.css');
        }
        return view('admin.setting.custom-css')->with(['custom_css' => $custom_css]);
    }

    public function update_customcss(Request $request)
    {
        file_put_contents('assets/front/css/dynamic-css.css', $request->custom_css_area);

        $notification = array(
            'messege' => 'Custom Style Added Success!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }
}
