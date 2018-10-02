<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'HomeController@index')->name('index');
Route::get('/faq', 'HomeController@faq')->name('faq');

Route::get('/exchange', 'HomeController@exchange')->name('exchange');
Route::get('/blogs', 'HomeController@blog')->name('blogs');
Route::get('/blogs/{slug}', 'HomeController@blogBySlug');
Route::get('contact', 'ContactController@index')->name('contact');
Route::get('terms', 'TermsController@index')->name('terms');
Route::post('contact/send', 'ContactController@send')->name('contact.send');
Route::get('/profile/{username}', 'HomeController@getUserProfile');
Route::get('/offer/{id}', 'OffersController@show');
Route::get('/delete-chat', 'HomeController@deleteChat');
Route::get('/offers/{type}', 'OffersController@getOffersByType'); 
Route::post('/search', 'HomeController@search');
Route::get("/calculate-coin/{id}/{investamount}",'User\TradesController@CalculateCoin');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */ 
Route::group(['middleware' => ['auth', 'password_expires', 'prevent-back-history']], function () {
    Route::resource('wallet', 'WalletController');
    Route::get('fund-transfer', 'WalletController@showFundTransfer');
    Route::post('get-coin-wallet', 'WalletController@getWalletOfSelectedCoin');
    Route::post('storeTransaction', 'WalletController@storeTransaction');


    Route::resource('rewards', 'RewardsController');

    Route::resource('groups', 'GroupController');
    Route::post('/upload',  'OffersController@imageUpload');
    Route::get('/trade/{id}', 'OffersController@chatConverstation');
    Route::get("/message/{id}", 'ConversationController@fetchMessages');
    Route::resource('conversations', 'ConversationController');
    Route::post('/notification/get', 'NotificationController@get');
    Route::post('/notification/read', 'NotificationController@read');
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
        Route::get('editprofile', 'ProfileController@editpageView')->name('editprofile');

        Route::get('register2fa', 'ProfileController@register2fa')->name('register2fa');
        

        Route::post('sendotp', 'ProfileController@updatePhoneAndSendOTP')->name('sendotp');
        Route::post('verifyotp', 'ProfileController@confirmPhone')->name('verifyotp');

        Route::get('changepassword', 'ProfileController@changePasswordView');
        Route::get('userprofile/{id}', 'ProfileController@getUserPicture');
        Route::get('my-offers', 'TradesController@index')->name("my-offers");
        Route::get('my-trades', 'TradesController@tradeindex')->name("my-trades");
        Route::get('new-offer', 'TradesController@create');
        Route::post('save-offer', 'TradesController@store');
        Route::get('edit-offer/{id}', 'TradesController@edit');
        Route::patch('offer-update', 'TradesController@update');
        Route::delete('delete-offer/{id}', 'TradesController@destroy');
        Route::post('update-offer-status', 'TradesController@updateTradeStatus');
        Route::get("/selectbox/{token_id}", 'TradesController@getExchangeRateSelectBox');
        Route::post("/get-exchange-rate",'TradesController@ExchangeRate');
        Route::post('/generate-tranaction',  'TradesController@fundescrow');
        Route::get("/network-fees/{token_id}", 'TradesController@getNetworkFeesData');
        Route::post('/get-trade-keys',  'TradesController@getTradeKeysDetails');
        Route::post('/storeEscrowTransaction',  'TradesController@storeEscrowTransaction');
    });
});
