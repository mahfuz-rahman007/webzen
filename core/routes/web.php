<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'setlang'], function(){

    Route::get('/', 'Front\FrontendController@index')->name('front.index');
    Route::get('/changeLang/{lang}', 'Front\FrontendController@changeLang')->name('front.changeLang');
    Route::get('/about', 'Front\FrontendController@about')->name('front.about');
    Route::get('/service', 'Front\FrontendController@service')->name('front.service');
    Route::get('/service/{slug}', 'Front\FrontendController@service_details')->name('front.service_details');

    Route::get('/contact', 'Front\FrontendController@contact')->name('front.contact');
    Route::post('/contact/submit', 'Front\FrontendController@contact_submit')->name('front.contact_submit');

    Route::get('/blog', 'Front\FrontendController@blogs')->name('front.blogs');
    Route::get('/blog-details/{slug}', 'Front\FrontendController@blog_details')->name('front.blog_details');






});


Route::group(['prefix'=>'admin' , 'middleware'=>'guest:admin'] ,function(){

    Route::get('/' , 'Admin\LoginController@login')->name('admin.login');
    Route::post('/login' , 'Admin\LoginController@authenticate')->name('admin.auth');

});

Route::group(['prefix'=>'admin' , 'middleware'=>'auth:admin'] ,function(){

    Route::get('/logout' , 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('/dashboard' , 'Admin\DashboardController@dashboard')->name('admin.dashboard');

    // Admin Profile Routs
    Route::get('/profile/edit', 'Admin\ProfileController@edit_profile')->name('admin.edit_profile');
    Route::post('/profile/update', 'Admin\ProfileController@update_profile')->name('admin.update_profile');
    Route::get('/profile/password/edit', 'Admin\ProfileController@edit_password')->name('admin.edit_password');
    Route::post('/profile/password/update', 'Admin\ProfileController@update_password')->name('admin.update_password');

    // Setting Routes
    // Basic Information
    Route::get('/basicinfo', 'Admin\SettingController@basicinfo')->name('admin.setting.basicinfo');
    Route::post('/basicinfo/update/{id}', 'Admin\SettingController@update_basicinfo')->name('admin.setting.update_basicinfo');
    Route::post('/commoninfo/update', 'Admin\SettingController@update_commoninfo')->name('admin.setting.update_commoninfo');

    // ADMIN EMAIL SETTINGS SECTION
    Route::get('/email-config', 'Admin\EmailController@config')->name('admin.mail.config');
    Route::post('/email-config/submit', 'Admin\EmailController@configUpdate')->name('admin.mail.config.update');

    // Social Links
    Route::get('/slinks', 'Admin\SocialController@slinks')->name('admin.slinks');
    Route::post('/slinks/store', 'Admin\SocialController@store_slinks')->name('admin.store_slinks');
    Route::get('/slinks/edit/{id}', 'Admin\SocialController@edit_slinks')->name('admin.edit_slinks');
    Route::post('/slinks/update/{id}', 'Admin\SocialController@update_slinks')->name('admin.update_slinks');
    Route::post('/slinks/delete/{id}', 'Admin\SocialController@delete_slinks')->name('admin.delete_slinks');

    // Seo Info Routes
    Route::get('/seoinfo', 'Admin\SettingController@seoinfo')->name('admin.seoinfo');
    Route::post('/seoinfo/update/{id}', 'Admin\SettingController@update_seoinfo')->name('admin.update_seoinfo');

    // Scripts Routes
    Route::get('/scripts', 'Admin\SettingController@scripts')->name('admin.scripts');
    Route::post('/scripts/update', 'Admin\SettingController@update_script')->name('admin.update_script');

    // page Visibility
    Route::get('/page-visibility', 'Admin\SettingController@pagevisibility')->name('admin.pagevisibility');
    Route::post('/page-visibility/update', 'Admin\SettingController@update_pagevisibility')->name('admin.update_pagevisibility');

    // Cookie Alert
    Route::get('/cookie-alert', 'Admin\SettingController@cookiealert')->name('admin.cookiealert');
    Route::post('/cookie-alert/update/{id}', 'Admin\SettingController@update_cookiealert')->name('admin.update_cookiealert');

    // Cusstom Css Routes
    Route::get('/custom-css', 'Admin\SettingController@customcss')->name('admin.customcss');
    Route::post('/custom-css/update', 'Admin\SettingController@update_customcss')->name('admin.update_customcss');

    // Package Route
    Route::get('/package', 'Admin\PackagController@package')->name('admin.package');
    Route::get('/package/add', 'Admin\PackagController@add_package')->name('admin.add_package');
    Route::post('/package/store', 'Admin\PackagController@store_package')->name('admin.store_package');
    Route::post('/package/delete/{id}/', 'Admin\PackagController@delete_package')->name('admin.delete_package');
    Route::get('/package/edit/{id}/', 'Admin\PackagController@edit_package')->name('admin.edit_package');
    Route::post('/package/update/{id}/', 'Admin\PackagController@update_package')->name('admin.update_package');
    Route::post('/package/plancontent/{id}/', 'Admin\PackagController@update_plancontent')->name('admin.update_plancontent');


    //Hpme Route
    Route::get('/home' , 'Admin\HomeController@home')->name('admin.home');
    Route::post('/home/update' , 'Admin\HomeController@update_home')->name('admin.update_home');

    // About Route
    Route::get('/about', 'Admin\AboutController@about')->name('admin.about');
    Route::get('/about/add', 'Admin\AboutController@add_about')->name('admin.add_about');
    Route::post('/about/store', 'Admin\AboutController@store_about')->name('admin.store_about');
    Route::post('/about/delete/{id}/', 'Admin\AboutController@delete_about')->name('admin.delete_about');
    Route::get('/about/edit/{id}/', 'Admin\AboutController@edit_about')->name('admin.edit_about');
    Route::post('/about/update/{id}/', 'Admin\AboutController@update_about')->name('admin.update_about');
    Route::post('/about/aboutcontent/{id}/', 'Admin\AboutController@update_aboutcontent')->name('admin.update_aboutcontent');

    // Fun Fact Route
    Route::get('/funfact', 'Admin\FunfactController@funfact')->name('admin.funfact');
    Route::get('/funfact/add', 'Admin\FunfactController@add_funfact')->name('admin.add_funfact');
    Route::post('/funfact/store', 'Admin\FunfactController@store_funfact')->name('admin.store_funfact');
    Route::post('/funfact/delete/{id}/', 'Admin\FunfactController@delete_funfact')->name('admin.delete_funfact');
    Route::get('/funfact/edit/{id}/', 'Admin\FunfactController@edit_funfact')->name('admin.edit_funfact');
    Route::post('/funfact/update/{id}/', 'Admin\FunfactController@update_funfact')->name('admin.update_funfact');
    Route::post('/funfact/funfactcontent/{id}/', 'Admin\FunfactController@update_funfactcontent')->name('admin.update_funfactcontent');


    // Service Route
    Route::get('/service', 'Admin\ServiceController@service')->name('admin.service');
    Route::get('/service/add', 'Admin\ServiceController@add_service')->name('admin.add_service');
    Route::post('/service/store', 'Admin\ServiceController@store_service')->name('admin.store_service');
    Route::post('/service/delete/{id}/', 'Admin\ServiceController@delete_service')->name('admin.delete_service');
    Route::get('/service/edit/{id}/', 'Admin\ServiceController@edit_service')->name('admin.edit_service');
    Route::post('/service/update/{id}/', 'Admin\ServiceController@update_service')->name('admin.update_service');
    Route::post('/service/servicecontent/{id}/', 'Admin\ServiceController@update_servicecontent')->name('admin.update_servicecontent');


    // Testimonial Route
    Route::get('/testimonial', 'Admin\TestimonialController@testimonial')->name('admin.testimonial');
    Route::get('/testimonial/add', 'Admin\TestimonialController@add_testimonial')->name('admin.add_testimonial');
    Route::post('/testimonial/store', 'Admin\TestimonialController@store_testimonial')->name('admin.store_testimonial');
    Route::post('/testimonial/delete/{id}/', 'Admin\TestimonialController@delete_testimonial')->name('admin.delete_testimonial');
    Route::get('/testimonial/edit/{id}/', 'Admin\TestimonialController@edit_testimonial')->name('admin.edit_testimonial');
    Route::post('/testimonial/update/{id}/', 'Admin\TestimonialController@update_testimonial')->name('admin.update_testimonial');
    Route::post('/testimonial/testimonialcontent/{id}/', 'Admin\TestimonialController@update_testimonialcontent')->name('admin.update_testimonialcontent');


    // Currency  Route
    Route::get('/currency', 'Admin\CurrencyController@currency')->name('admin.currency');
    Route::get('/currency/add', 'Admin\CurrencyController@add_currency')->name('admin.add_currency');
    Route::post('/currency/store', 'Admin\CurrencyController@store_currency')->name('admin.store_currency');
    Route::post('/currency/delete/{id}/', 'Admin\CurrencyController@delete_currency')->name('admin.delete_currency');
    Route::get('/currency/edit/{id}/', 'Admin\CurrencyController@edit_currency')->name('admin.edit_currency');
    Route::post('/currency/update/{id}/', 'Admin\CurrencyController@update_currency')->name('admin.update_currency');
    Route::get('/currency/status/set/{id}', 'Admin\CurrencyController@update_currencystatus')->name('admin.update_currencystatus');

    // Members Route
    Route::get('/faq', 'Admin\FaqController@faq')->name('admin.faq');
    Route::get('/faq/add', 'Admin\FaqController@add_faq')->name('admin.add_faq');
    Route::post('/faq/store', 'Admin\FaqController@store_faq')->name('admin.store_faq');
    Route::post('/faq/delete/{id}/', 'Admin\FaqController@delete_faq')->name('admin.delete_faq');
    Route::get('/faq/edit/{id}/', 'Admin\FaqController@edit_faq')->name('admin.edit_faq');
    Route::post('/faq/update/{id}/', 'Admin\FaqController@update_faq')->name('admin.update_faq');


    // Members Route
    Route::get('/team', 'Admin\TeamController@team')->name('admin.team');
    Route::get('/team/add', 'Admin\TeamController@add_team')->name('admin.add_team');
    Route::post('/team/store', 'Admin\TeamController@store_team')->name('admin.store_team');
    Route::post('/team/delete/{id}/', 'Admin\TeamController@delete_team')->name('admin.delete_team');
    Route::get('/team/edit/{id}/', 'Admin\TeamController@edit_team')->name('admin.edit_team');
    Route::post('/team/update/{id}/', 'Admin\TeamController@update_team')->name('admin.update_team');
    Route::post('/team/teamcontent/{id}/', 'Admin\TeamController@update_teamcontent')->name('admin.update_teamcontent');

    // Blog Category RouteF
    Route::get('/blog/blog-category', 'Admin\BcategoryController@bcategory')->name('admin.bcategory');
    Route::get('/blog/blog-category/add', 'Admin\BcategoryController@add_bcategory')->name('admin.add_bcategory');
    Route::post('/blog/blog-category/store', 'Admin\BcategoryController@store_bcategory')->name('admin.store_bcategory');
    Route::post('/blog/blog-category/delete/{id}/', 'Admin\BcategoryController@delete_bcategory')->name('admin.delete_bcategory');
    Route::get('/blog/blog-category/edit/{id}/', 'Admin\BcategoryController@edit_bcategory')->name('admin.edit_bcategory');
    Route::post('/blog/blog-category/update/{id}/', 'Admin\BcategoryController@update_bcategory')->name('admin.update_bcategory');

    // Blog  Route
    Route::get('/blog', 'Admin\BlogController@blog')->name('admin.blog');
    Route::get('/blog/add', 'Admin\BlogController@add_blog')->name('admin.add_blog');
    Route::post('/blog/store', 'Admin\BlogController@store_blog')->name('admin.store_blog');
    Route::post('/blog/delete/{id}/', 'Admin\BlogController@delete_blog')->name('admin.delete_blog');
    Route::get('/blog/edit/{id}/', 'Admin\BlogController@edit_blog')->name('admin.edit_blog');
    Route::post('/blog/update/{id}/', 'Admin\BlogController@update_blog')->name('admin.update_blog');
    Route::post('/blog/blogcontent/{id}/', 'Admin\BlogController@update_blogcontent')->name('admin.update_blogcontent');
    Route::get('blog/get/category/{id}', 'Admin\BlogController@blog_get_category')->name('admin.blog_get_category');


    // Client Route
    Route::get('/client' , 'Admin\ClientController@client')->name('admin.client');
    Route::get('/client/add' , 'Admin\ClientController@add_client')->name('admin.add_client');
    Route::post('/client/store' , 'Admin\ClientController@store_client')->name('admin.store_client');
    Route::get('/client/edit/{id}/' , 'Admin\ClientController@edit_client')->name('admin.edit_client');
    Route::post('/client/update/{id}/' , 'Admin\ClientController@update_client')->name('admin.update_client');
    Route::post('/client/delete/{id}/' , 'Admin\ClientController@delete_client')->name('admin.delete_client');

    // Dynamic Page  Route
    Route::get('/dynamic-page', 'Admin\DynamicpageController@dynamic_page')->name('admin.dynamic_page');
    Route::get('/dynamic-page/add', 'Admin\DynamicpageController@add')->name('admin.dynamic_page.add');
    Route::post('/dynamic-page/store', 'Admin\DynamicpageController@store')->name('admin.dynamic_page.store');
    Route::post('/dynamic-page/delete/{id}/', 'Admin\DynamicpageController@delete')->name('admin.dynamic_page.delete');
    Route::get('/dynamic-page/edit/{id}/', 'Admin\DynamicpageController@edit')->name('admin.dynamic_page.edit');
    Route::post('/dynamic-page/update/{id}/', 'Admin\DynamicpageController@update')->name('admin.dynamic_page.update');


    // Admin Languages Routes
    Route::get('/languages', 'Admin\LanguageController@index')->name('admin.language.index');
    Route::get('/language/add', 'Admin\LanguageController@add')->name('admin.language.add');
    Route::post('/language/store', 'Admin\LanguageController@store')->name('admin.language.store');
    Route::get('/language/{id}/edit', 'Admin\LanguageController@edit')->name('admin.language.edit');
    Route::get('/language/{id}/edit/keyword', 'Admin\LanguageController@edit_keyword')->name('admin.language.edit_keyword');

    Route::post('/language/{id}/default', 'Admin\LanguageController@default')->name('admin.language.default');

    Route::post('/language/{id}/delete', 'Admin\LanguageController@delete')->name('admin.language.delete');
    Route::post('/language/{id}/update', 'Admin\LanguageController@update')->name('admin.language.update');
    Route::post('/language/{id}/update/keyword', 'Admin\LanguageController@update_keyword')->name('admin.language.update_keyword');


    // Admin Footer Logo Text Routes
    Route::get('/footer', 'Admin\FooterController@index')->name('admin.footer');
    Route::post('/footer/update/{id}', 'Admin\FooterController@update_footer')->name('admin.update_footer');



});

Route::group(['middleware' => 'setlang'], function () {

    Route::get('/{slug}', 'Front\FrontendController@front_dynamic_page')->name('front.front_dynamic_page');

});
