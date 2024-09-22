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

// Route::get('update-faq', function(){
//       $seo = \App\Models\Faq::get();        
//         foreach($seo as $value){      
//             $value->title = json_encode(['en' => $value->title]);
//             $value->description = json_encode(['en' => $value->description]); 
//            $value->save();
//         }      
//   dd("Record updated successfully.");
// });


// Route::get('update-about-us', function(){
//       $seo = \App\Models\AboutUs::get();        
//         foreach($seo as $value){      
//             $value->title = json_encode(['en' => $value->title]);
//             $value->description = json_encode(['en' => $value->description]); 
//            $value->save();
//         }      
//   dd("Record updated successfully.");
// });


// Route::get('update-seo', function(){
//        $seo = \App\Models\Seo::get();        
//         foreach($seo as $value){
//           $value->title = json_encode(['en' => $value->title]);
//           $value->meta_title = json_encode(['en' => $value->meta_title]);
//           $value->meta_des = json_encode(['en' => $value->meta_des]);
//           $value->save();
//         }
//          dd("Record updated successfully.");
// });



/* START:Backend */
Route::group(['prefix' => 'backend', 'namespace' => 'Backend', 'as'=>'backend.'], function () {

    /* Auth */
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => ['auth:backend']], function () {

        /* Account */
        Route::group(['prefix' => 'account', 'as'=>'account.', 'middleware' => 'role:admin|moderator'], function () {
            Route::get('/profile', 'ProfileController@viewProfile')->name('profile.view');
            Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');
            Route::post('/profile/remove-image/{id}', 'ProfileController@removeImage')->name('profile.remove-image');
            Route::get('change-password', 'ProfileController@viewChangePassword')->name('change-password.view');
            Route::post('change-password', 'ProfileController@saveChangePassword')->name('change-password.update');
        });
        
        Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('role:admin|moderator');

        /* Faq */
        Route::resource('faq', 'FaqController')->middleware('role:admin');

        /* Contact us */
        Route::resource('enquiry', 'ContactUsController')->middleware('role:admin|moderator');
 

        Route::group(['prefix' => 'enquiry', 'as'=>'enquiry.', 'middleware' => 'role:admin|moderator'], function () {
        
        Route::post('removeall', 'ContactUsController@removeall')->name('removeall');
        
        });


        /* Setting */
        Route::resource('setting', 'SettingController')->middleware('role:admin');

        /*  CMS About Us */
        Route::resource('aboutus', 'AboutUsController')->middleware('role:admin');

        /*  CMS HOME Trusted By */
        Route::resource('trusted-logo', 'TrustedController')->middleware('role:admin');

        /* CMS Custom Pages */
        Route::resource('custom-page', 'CustomPageController')->middleware('role:admin');

        /*-- SEO --*/
        Route::resource('seo', 'SeoController')->middleware('role:admin');

        /* Orders */
        Route::get('orders', 'OrderController@index')->name('orders.index')->middleware('role:admin|moderator');
        
        /*--- Exchange ----*/
        Route::resource('exchange', 'ExchangeController')->middleware('role:admin');

        /*--- Coin Info ----*/
        Route::get('coins', 'CoinController@index')->name('coins.index')->middleware('role:admin');
        Route::get('coins/{id}/edit', 'CoinController@edit')->name('coins.edit')->middleware('role:admin');
        Route::put('coins/{id}', 'CoinController@update')->name('coins.update')->middleware('role:admin');
        
        /*--- show log info ----*/
        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs')->middleware('role:admin');


        Route::get('coins', 'CoinController@index')->name('coins.index')->middleware('role:admin');
        
        /*--- referral_commission -----*/

        Route::group(['prefix' => 'affiliate', 'as'=>'affiliate.'], function () {

           Route::resource('referral-commission', 'ReferralCommissionController');

           Route::get('commission-report', 'ReferralCommissionController@commissionReport')->name('commission-report');

       });
    });
});

$locale = Request::segment(1);

if(array_key_exists($locale, config('constants.supported_languages'))){
    app()->setLocale($locale);
}else{
    app()->setLocale('en');
    $locale = '';
}



Route::get($locale.'/', 'HomeController@index')->name('home');

// Route::get('{from_coin}/{to_coin}', 'HomeController@coin_pairs')->name('coin-pairs');

Route::get($locale.'/about', 'HomeController@aboutus')->name('about');

Route::get($locale.'/history','HistoryController@index')->name('history');

Route::get('contact-us','HomeController@contact')->name('contact-us');

Route::get($locale.'/exchange', 'ExchangeController@index')->name('exchange');
Route::post('create-exchange', 'ExchangeController@exchange')->name('create-exchange');

Route::get($locale.'/exchange/{slug}', 'ExchangeController@show')->name('exchange-detail');


Route::post('get-exchange-amount', 'HomeController@getExchangeAmount')->name('get-exchange-amount');

Route::get('order/{order_id}', 'HomeController@order')->name('order');

Route::post($locale.'/exchange', 'HomeController@exchange');

Route::get($locale.'/faq', 'FaqController@index')->name('faq');
Route::get($locale.'/faq/{slug}', 'FaqController@details')->name('faq-details');

Route::post('get-pair-rate', 'HomeController@getPairRate')->name('get-pair-rate');

Route::post('send-inquiry', 'HomeController@sendInquiry')->name('send-inquiry');

Route::get($locale.'/privacy-policy', 'HomeController@privacy_policy')->name('privacy-policy');

Route::get($locale.'/term-condition', 'HomeController@term_condition')->name('term-condition');

Route::get('sitemap.xml', 'HomeController@sitemap')->name('sitemap');

Route::get($locale.'/how-it-works', 'HomeController@howItWorks')->name('how-it-works');

Route::get('affiliate', 'AffiliateController@index')->name('affiliate');
Route::post('create_affiliate_user', 'AffiliateController@store')->name('create_affiliate_user');

Route::post('check_affiliate_user', 'AffiliateController@checkAffiliateUser')->name('check_affiliate_user');

Route::get('affiliate/{id}', 'AffiliateController@profile')->name('affiliate-profile');

Route::post('redeem_amout_request', 'AffiliateController@redeemAmoutRequest')->name('redeem_amout_request');
