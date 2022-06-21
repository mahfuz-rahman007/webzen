<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Package;
use App\Service;
use App\Team;
use App\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        $packages = Package::all();
        $latestpackages = Package::orderBy('id', 'DESC')->limit(10)->get();
        $service = Service::all();
        $blogs = Blog::all();
        $latestblogs = Blog::orderBy('id', 'DESC')->limit(10)->get();
        $testimonial = Testimonial::all();
        $team = Team::all();

        return view('admin.dashboard', compact('packages', 'service',  'blogs', 'testimonial', 'team', 'latestpackages', 'latestblogs',));
    }
}
