<?php

namespace App\Http\Controllers\Front;

use App\About;
use App\Bcategory;
use App\Blog;
use App\Client;
use App\Dynamicpage;
use App\Emailsetting;
use App\Faq;
use App\Funfact;
use App\Http\Controllers\Controller;
use App\Language;
use App\Package;
use App\Sectiontitle;
use App\Service;
use App\Team;
use App\Testimonial;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $data['abouts'] = About::where('status', 1)->where('language_id', $currlang->id)->get();
        $data['sectionInfo'] = Sectiontitle::where('language_id', $currlang->id)->first();
        $data['teams'] = Team::where('status', 1)->where('language_id', $currlang->id)->get();

        $data['services'] = Service::where('status', 1)->where('language_id', $currlang->id)->limit(6)->get();
        $data['testimonials'] = Testimonial::where('language_id', $currlang->id)->orderBy('id', 'DESC')->get();
        $data['funfacts'] = Funfact::where('language_id', $currlang->id)->orderBy('id', 'DESC')->get();
        $data['clients'] = Client::orderBy('id', 'DESC')->get();


        return view('front.index', $data);
    }


    // Change Language
    public function changeLang($lang)
    {

        session()->put('lang', $lang);
        app()->setLocale($lang);

        return redirect(route('front.index'));
    }

    public function about()
    {
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $data['abouts'] = About::where('status', 1)->where('language_id', $currlang->id)->get();
        $data['sectionInfo'] = Sectiontitle::where('language_id', $currlang->id)->first();
        $data['funfacts'] = Funfact::where('language_id', $currlang->id)->orderBy('id', 'DESC')->get();
        $data['faqs'] = Faq::where('status', 1)->where('language_id', $currlang->id)->get();

        return view('front.about', $data);
    }

    public function service()
    {
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $data['services'] = Service::where('status', 1)->where('language_id', $currlang->id)->limit(6)->get();
        $data['plans'] = Package::where('status', 1)->where('language_id', $currlang->id)->get();
        $data['sectionInfo'] = Sectiontitle::where('language_id', $currlang->id)->first();

        return view('front.service', $data);
    }

    public function service_details($slug)
    {
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $data['service'] = Service::where('slug', $slug)->where('language_id', $currlang->id)->firstOrFail();
        $data['all_services'] = Service::where('status', 1)->where('language_id', $currlang->id)->orderBy('id', 'DESC')->get();
        $data['sectionInfo'] = Sectiontitle::where('language_id', $currlang->id)->first();


        return view('front.service-details', $data);
    }


    public function blogs(Request $request)
    {
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $category = $request->category;
        $catid = null;

        if (!empty($category)) {
            $data['category'] = Bcategory::where('slug', $category)->firstOrFail();
            $catid = $data['category']->id;
        }

        $term = $request->term;

        $bcategories = Bcategory::where('status', 1)->where('language_id', $currlang->id)->get();

        $latestBlogs = Blog::where('status', 1)->where('language_id', $currlang->id)->orderBy('id', 'DESC')->limit(4)->get();
        $sectionInfo = Sectiontitle::where('language_id', $currlang->id)->first();

        $count_blog = Blog::where('status', 1)->where('language_id', $currlang->id)->count();

        $blogs = Blog::where('status', 1)->where('language_id', $currlang->id)
            ->when($catid, function ($query, $catid) {
                return $query->where('bcategory_id', $catid);
            })
            ->when($term, function ($query, $term) {
                return $query->where('title', 'like', '%' . $term . '%');
            })
            ->orderBy('id', 'DESC')->paginate(4);

        return view('front.blog', compact('bcategories', 'latestBlogs', 'blogs', 'sectionInfo', 'count_blog'));
    }

    public function blog_details(Request $request, $slug)
    {
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }


        $bcategories = Bcategory::where('status', 1)->where('language_id', $currlang->id)->get();

        $latestBlogs = Blog::where('status', 1)->where('language_id', $currlang->id)->orderBy('id', 'DESC')->limit(4)->get();
        $sectionInfo = Sectiontitle::where('language_id', $currlang->id)->first();

        $count_blog = Blog::where('status', 1)->where('language_id', $currlang->id)->count();

        $blog = Blog::where('slug', $slug)->where('language_id', $currlang->id)->firstOrFail();

        return view('front.blog-details', compact('bcategories', 'latestBlogs', 'blog', 'sectionInfo', 'count_blog'));
    }

    public function contact()
    {
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $data['sectionInfo'] = Sectiontitle::where('language_id', $currlang->id)->first();

        return view('front.contact', $data);
    }

    public function contact_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required|string',
        ]);

        // Login Section
        $name = $request->name;
        $fromemail = $request->email;
        $number = $request->phone;
        $mail = new PHPMailer(true);
        $em = Emailsetting::first();
        if ($em->is_smtp == 1) {
            try {
                $mail->isSMTP();
                $mail->Host       = $em->smtp_host;
                $mail->SMTPAuth   = true;
                $mail->Username   = $em->smtp_user;
                $mail->Password   = $em->smtp_pass;
                $mail->SMTPSecure = $em->email_encryption;
                $mail->Port       = $em->smtp_port;

                //Recipients
                $mail->setFrom($fromemail, $name);
                $mail->addAddress($em->from_email, $em->from_name);

                // Content
                $mail->isHTML(true);
                $mail->Subject = "User message from contact page";
                $mail->Body    = "Name: " . $name . "</br>Email: " . $fromemail . "</br>Phone: " . $number . "</br>Message: " . $request->message;

                $mail->send();
            } catch (Exception $e) {
                // die($e->getMessage());
            }
        } else {
            try {
                //Recipients
                $mail->setFrom($fromemail, $name);
                $mail->addAddress($em->from_email, $em->from_name);


                // Content
                $mail->isHTML(true);
                $mail->Subject = "User message from contact page";
                $mail->Body    = "Name: " . $name . "</br>Email: " . $fromemail . "</br>Phone: " . $number . "</br>Message: " . $request->message;

                $mail->send();
            } catch (Exception $e) {
                // die($e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Your Email Has Been Sent!!');
    }

    public function front_dynamic_page($slug){
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }

        $front_dynamic_page = Dynamicpage::where('slug', $slug)->where('language_id', $currlang->id)->firstOrFail();

        return view('front.dynamic-page', compact('front_dynamic_page'));

    }
}
