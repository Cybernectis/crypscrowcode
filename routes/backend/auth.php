<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'auth',
    'as'         => 'auth.',
    'namespace'  => 'Auth',
    'middleware' => 'prevent-back-history'
], function () {
    Route::group([
        'middleware' => 'role:administrator|executive',
    ], function () {
        /*
         * User Management
         */
        Route::group(['namespace' => 'User'], function () {

            /*
             * User Status'
             */
            Route::get('user/deactivated', 'UserStatusController@getDeactivated')->name('user.deactivated');
            Route::get('user/deleted', 'UserStatusController@getDeleted')->name('user.deleted');
            Route::get('view/trades/{user}', 'UserViewTradesController@show')->name('user.view.trades');
            /*
             * User CRUD
             */
            Route::resource('user', 'UserController');

            /*
             * Specific User
             */
            Route::group(['prefix' => 'user/{user}'], function () {
                // Account
                Route::get('account/confirm/resend', 'UserConfirmationController@sendConfirmationEmail')->name('user.account.confirm.resend');

                // Status
                Route::get('mark/{status}', 'UserStatusController@mark')->name('user.mark')->where(['status' => '[0,1]']);

                // Social
                Route::delete('social/{social}/unlink', 'UserSocialController@unlink')->name('user.social.unlink');

                // Confirmation
                Route::get('confirm', 'UserConfirmationController@confirm')->name('user.confirm');
                Route::get('unconfirm', 'UserConfirmationController@unconfirm')->name('user.unconfirm');

                // Password
                Route::get('password/change', 'UserPasswordController@edit')->name('user.change-password');
                Route::patch('password/change', 'UserPasswordController@update')->name('user.change-password.post');

                // Access
                Route::get('login-as', 'UserAccessController@loginAs')->name('user.login-as');

                // Session
                Route::get('clear-session', 'UserSessionController@clearSession')->name('user.clear-session');
            });

            /*
             * Deleted User
             */
            Route::group(['prefix' => 'user/{deletedUser}'], function () {
                Route::get('delete', 'UserStatusController@delete')->name('user.delete-permanently');
                Route::get('restore', 'UserStatusController@restore')->name('user.restore');
            });
        });

        /*
         * Role Management
         */
        Route::group(['namespace' => 'Role'], function () {
            Route::resource('role', 'RoleController', ['except' => ['show']]);
        });

        /*
         * Wallet Management
         */
        Route::group(['namespace' => 'Wallet'], function () {
            Route::post("/genrateaddress",'WalletController@genrateaddress');
            Route::resource('wallet', 'WalletController', ['except' => ['show']]);
        });


        /*
         * Setting Management
         */
        Route::group(['namespace' => 'Settings'], function () {
            Route::resource('settings', 'SettingsController', ['except' => ['show']]);
        });

        /*
         * Localcoins Management
         */
        Route::group(['namespace' => 'Localcoins'], function () {
            Route::resource('localcoins', 'LocalcoinsController', ['except' => ['show']]);
        });


        /*
         * Exchange Management
         */
        Route::group(['namespace' => 'Exchange'], function () {
            Route::resource('exchangerate', 'ExchangeController', ['except' => ['show']]);
        });


        /*
         * Dispute Management
         */
        Route::group(['namespace' => 'Dispute'], function () {
            Route::get('chatview/{id}', 'DisputeController@chatViewIndex');
            Route::resource('dispute', 'DisputeController');
        });
        

        /*
         * Payments Management
         */
        Route::group(['namespace' => 'Payments'], function () {
            Route::resource('payments', 'PaymentController');
        });


         /*
         * Pages Management
         */
        Route::group(['namespace' => 'Pages'], function () {
            Route::resource('pages', 'PagesController');
        });
        /*
         * Pages Management
         */
        Route::group(['namespace' => 'Pages'], function () {
            Route::resource('pages/section', 'PagesSectionController');
        });

        /*
         * affiliates Management
         */
        Route::group(['namespace' => 'Affiliates'], function () {

            Route::resource('affiliates', 'AffiliatesController');
        });
        

        /*
         * Statistic Management
         */ 
        Route::group(['namespace' => 'Stats'], function () {
            // Route::get('stats/all', 'StatsController@allRequests')->name("all-requests");
            Route::resource('stats', 'StatsController');
            
        });

        /*
         * Fund Management
         */ 
        Route::group(['namespace' => 'Funds'], function () {
            Route::resource('funds', 'FundsTransferController');
        });


         /*
         * Blog Management
         */ 
        Route::group(['namespace' => 'Blogs'], function () {
            Route::resource('blogs', 'BlogsController');
        });


         /*
         * Blog Management
         */ 
        Route::group(['namespace' => 'Rewards'], function () {
            Route::resource('rewards', 'RewardsController');
        });
    });
});
