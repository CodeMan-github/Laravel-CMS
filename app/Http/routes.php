<?php

$logo_settings=\App\Settings::where('column_key','logo_120')->first();

\View::share('logo', $logo_settings->value_string);

get('/', 'HomeController@index');
get('/article/{id}', 'HomeController@show');
get('/rss.xml', 'HomeController@rss');
get('/sitemap.xml', 'HomeController@sitemap');
get('/login', 'AuthController@getLogin');
get('/forgot-password', 'AuthController@getForgotPassword');
post('/forgot-password', 'AuthController@postForgotPassword');
post('/login', 'AuthController@postLogin');
get('/logout', 'AuthController@getLogout');
post('/reset_password', 'AuthController@postReset');
get('/reset_password/{email}/{reset_code}', 'AuthController@getReset');
post('/forgot_password', 'AuthController@getForgotPassword');

//customer routes
get('/customer/login', 'AuthController@getCustomerLogin');
post('/customer/login', 'AuthController@customerPostLogin');
get('/customer/register', 'AuthController@getCustomerRegister');
post('/customer/register', 'AuthController@registerCustomer');

Route::group(array('middleware' => 'customer_auth'), function () {
    get('/customer', 'CustomerController@posts');
    get('/customer/posts/create', 'CustomerController@create');
    post('/customer/posts/create', 'CustomerController@store');
    get('/customer/posts/edit/{id}', 'CustomerController@edit')->where(array('id' => '[0-9]+'));
    post('/customer/posts/update', 'CustomerController@update');
    get('/customer/posts/delete/{id}', 'CustomerController@delete')->where(array('id' => '[0-9]+'));
    get('/customer/profile', 'CustomerController@profileEdit');
    post('/customer/profile/update', 'CustomerController@profileupdate');

    get('/customer/logout', 'AuthController@getCustomerLogout');




});


//Error Handler
get('/403', 'HomeController@show403');
get('/getcwd', function(){
    return getcwd();
});
get('/locatephp5', function(){
    return exec('locate php5');
});
get('/locatephp', function(){    
	return exec('locate php');
});
get('/404', 'HomeController@show404');
get('/500', 'HomeController@show500');
get('/503', 'HomeController@show503');

//Site Routes
get('/page/{page_slug}', 'HomeController@page');
get('/author/{author_slug}', 'HomeController@byAuthor');
get('/category/{category_slug}', 'HomeController@byCategory');
get('/category/{category_slug}/{sub_category_slug}', 'HomeController@bySubCategory');
get('/tag/{tag_slug}', 'HomeController@byTag');
get('/search', 'HomeController@bySearch');
get('/rss.xml', 'HomeController@rss');
get('/rss', 'HomeController@rss');
get('/rss/{category_slug}', 'HomeController@categoryRss');
get('/rss/{category_slug}/{sub_category_slug}', 'HomeController@subCategoryRss');
get('/sitemap.xml', 'HomeController@sitemap');

post('/submit_rating', 'HomeController@submitRating');
post('/submit_likes', 'HomeController@submitLike');

//Admin Routes
Route::group(array('namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'), function () {

    get('/', 'DashboardController@index');

    get('/update_application', 'DashboardController@updateApplication');

    get('/gvva-access', 'DashboardController@giveMeWriteAccess');
    get('/rmva-access', 'DashboardController@removeWriteAccess');

    Route::group(array('prefix' => 'api'), function () {
        get('/get_tags', 'APIController@getTags');
    });

    Route::group(array('prefix' => 'crons'), function () {

        get('/', 'CronController@all');
        get('/all', 'CronController@all');
        get('/run', 'CronController@run');

        get('/view/{id}', 'CronController@view')->where(array('id' => '[0-9]+'));
        get('/delete/{id}', 'CronController@delete')->where(array('id' => '[0-9]+'));;

    });

    Route::group(array('prefix' => 'roles'), function () {

        get('/', 'UserRolesController@all');
        get('/all', 'UserRolesController@all');

        get('/create', 'UserRolesController@create');
        get('/edit/{id}', 'UserRolesController@edit')->where(array('id' => '[0-9]+'));
        get('/delete/{id}', 'UserRolesController@delete')->where(array('id' => '[0-9]+'));;

        post('/create', 'UserRolesController@store');
        post('/update', 'UserRolesController@update');

    });


    Route::group(array('prefix' => 'users'), function () {

        get('/', 'UsersController@all');
        get('/all', 'UsersController@all');

        get('/create', 'UsersController@create');
        get('/edit/{id}', 'UsersController@edit')->where(array('id' => '[0-9]+'));
        get('/delete/{id}', 'UsersController@delete')->where(array('id' => '[0-9]+'));;

        post('/create', 'UsersController@store');
        post('/update', 'UsersController@update');

    });

    Route::group(array('prefix' => 'categories'), function () {

        get('/', 'CategoryController@all');
        get('/all', 'CategoryController@all');

        get('/create', 'CategoryController@create');
        get('/edit/{id}', 'CategoryController@edit')->where(array('id' => '[0-9]+'));;
        get('/delete/{id}', 'CategoryController@delete')->where(array('id' => '[0-9]+'));;

        post('/create', 'CategoryController@store');
        post('/update', 'CategoryController@update');

    });

    Route::group(array('prefix' => 'sub_categories'), function () {

        get('/', 'SubCategoryController@all');
        get('/all', 'SubCategoryController@all');

        get('/create', 'SubCategoryController@create');
        get('/edit/{id}', 'SubCategoryController@edit')->where(array('id' => '[0-9]+'));;
        get('/delete/{id}', 'SubCategoryController@delete')->where(array('id' => '[0-9]+'));;

        post('/create', 'SubCategoryController@store');
        post('/update', 'SubCategoryController@update');

    });

    Route::group(array('prefix' => 'sources'), function () {

        get('/', 'SourcesController@all');
        get('/all', 'SourcesController@all');
        get('/pull_feeds', 'SourcesController@pullFeeds');
        get('/pull_page', 'SourcesController@pullPages');

        get('/create', 'SourcesController@create');
        get('/edit/{id}', 'SourcesController@edit')->where(array('id' => '[0-9]+'));;
        get('/refresh/{id}', 'SourcesController@refresh')->where(array('id' => '[0-9]+'));;
        get('/delete/{id}', 'SourcesController@delete')->where(array('id' => '[0-9]+'));;

        post('/create', 'SourcesController@store');
        post('/update', 'SourcesController@update');

    });

    Route::group(array('prefix' => 'posts'), function () {

        get('/', 'PostsController@all');
        get('/all', 'PostsController@all');

        get('/create', 'PostsController@create');
        get('/edit/{id}', 'PostsController@edit')->where(array('id' => '[0-9]+'));
        get('/delete/{id}', 'PostsController@delete')->where(array('id' => '[0-9]+'));

        post('/create', 'PostsController@store');
        post('/update', 'PostsController@update');

    });

    Route::group(array('prefix' => 'lists'), function () {

        get('/', 'ListsController@all');
        get('/all', 'PostsController@all');

        get('/create', 'ListsController@create');
        get('/edit/{id}', 'ListsController@edit')->where(array('id' => '[0-9]+'));
        get('/delete/{id}', 'ListsController@delete')->where(array('id' => '[0-9]+'));

        post('/create', 'ListsController@store');
        post('/update', 'ListsController@update');

    });

    Route::group(array('prefix' => 'ratings'), function () {
        get('/', 'RatingsController@all');
        get('/all', 'RatingsController@all');
        get('/delete/{id}', 'RatingsController@delete')->where(array('id' => '[0-9]+'));
    });

    Route::group(array('prefix' => 'tags'), function () {
        get('/', 'TagsController@all');
        get('/all', 'TagsController@all');
        get('/delete/{id}', 'TagsController@delete')->where(array('id' => '[0-9]+'));
    });

    Route::group(array('prefix' => 'pages'), function () {

        get('/', 'PagesController@all');
        get('/all', 'PagesController@all');

        get('/create', 'PagesController@create');
        get('/edit/{id}', 'PagesController@edit')->where(array('id' => '[0-9]+'));
        get('/delete/{id}', 'PagesController@delete')->where(array('id' => '[0-9]+'));

        post('/create', 'PagesController@store');
        post('/update', 'PagesController@update');

    });

    Route::group(array('prefix' => 'ads'), function () {

        get('/', 'AdsController@all');
        get('/all', 'AdsController@all');

        get('/create', 'AdsController@create');
        get('/edit/{id}', 'AdsController@edit')->where(array('id' => '[0-9]+'));;
        get('/delete/{id}', 'AdsController@delete')->where(array('id' => '[0-9]+'));;

        post('/create', 'AdsController@store');
        post('/update', 'AdsController@update');

    });

    Route::group(array('prefix' => 'statistics'), function () {

        get('/', 'StatisticsController@all');
        get('/all', 'StatisticsController@all');


    });

    Route::group(array('prefix' => 'settings'), function () {

        get('/', 'SettingsController@all');
        get('/all', 'SettingsController@all');
        get('delete_manually/{days}', 'SettingsController@deleteOldManually');

        post('update_custom_css', 'SettingsController@updateCustomCSS');
        post('update_custom_js', 'SettingsController@updateCustomJS');
        post('update_social', 'SettingsController@updateSocial');
        post('update_comments', 'SettingsController@updateComments');
        post('update_seo', 'SettingsController@updateSEO');
        post('update_general', 'SettingsController@updateGeneral');
        post('delete_old_news', 'SettingsController@updateDeleteNews');

    });





});

Route::get('/admin/api/get_sub_categories_by_category/{id}', 'Admin\APIController@getSubCategories');
Route::get('/admin/redactor/images.json', 'DashboardController@redactorImages');
Route::post('/admin/redactor', 'DashboardController@handleRedactorUploads');

get('/crons/run', 'CronController@run');


//should be last route
get('/{article_slug}', 'HomeController@article');
