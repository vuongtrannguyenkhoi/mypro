<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as'=>'homepage','uses'=>'HomeController@getIndex'));
Route::get('home/trang-chu', array('as'=>'homepage','uses'=>'HomeController@getIndex'));
Route::get('pages/{pageSlug}', 'PagesController@show');
Route::get('galleries/{gallerySlug}', 'GalleriesController@show');

//Posts
Route::get('posts/{category}','PostsController@index');
Route::get('posts/{category}/{subcategory}','PostsController@index');
Route::get('posts/{subcategory}/{id}/{postSlug}','PostsController@show');
//

Route::get('login',array('as'=>'login','uses'=>'SessionsController@create') );
Route::get('logout',array('as'=>'logout','uses'=>'SessionsController@destroy') );
Route::resource('sessions','SessionsController',array('only'=>array('create','destroy','store')));

Route::post('contact','FormController@postSubmit');

Route::group(array('prefix' => 'admin','before'=>'authAdmin'), function()
{
    Route::get('dashboard',array( 'as'=>'admin.dashboard','uses'=>'Admin\DashboardController@index'));
    Route::get('dashboard/view',array( 'as'=>'admin.dashboard','uses'=>'Admin\DashboardController@view'));
    Route::post('siteconfigs','Admin\SiteconfigsController@postSave');
    Route::get('siteconfigs','Admin\SiteconfigsController@index');
    Route::get('api/users', array('as'=>'admin.api.users', 'uses'=>'Admin\UsersController@getDatatable'));
    Route::resource('users', 'Admin\UsersController');
    Route::resource('users.profiles', 'ProfilesController');
    //hdtuition routes
    Route::get('categories/order','Admin\CategoriesController@getOrder');
    Route::get('categories/modal-order','Admin\CategoriesController@getModalOrder');
    Route::post('categories/order-ajax','Admin\CategoriesController@postOrderAjax');
    Route::get('categories/template/{controller}','Admin\CategoriesController@getTemplate');
    Route::resource('categories','Admin\CategoriesController');

    Route::resource('pages','Admin\PagesController');
    Route::resource('boxes','Admin\BoxesController');
    Route::resource('controllers','Admin\ControllersController');
    Route::resource('templates','Admin\TemplatesController');
    Route::resource('posts','Admin\PostsController');
    Route::resource('galleries','Admin\GalleriesController');
    //photo route
    Route::post('photos/update-order','Admin\PhotosController@postUpdateOrder');
    Route::resource('galleries.photos','Admin\PhotosController');

    //orders
    Route::get('api/orders', array('as'=>'admin.api.orders', 'uses'=>'Admin\OrdersController@getDatatable'));
    Route::resource('orders','Admin\OrdersController');
});

Route::group(array('prefix'=>'portal'),function(){

    Route::get('dashboard',array( 'as'=>'portal_view_path','uses'=>'Portal\DashboardController@index'));
    Route::get('dashboard/view',array( 'as'=>'portal_dashboard_view_path','uses'=>'Portal\DashboardController@view'));

    //topics
    Route::get('forums/{id}/{slug}',array( 'as'=>'portal_topics_view_path','uses'=>'Portal\ForumsController@getTopics'));
    Route::get('forums/topics/{topicId}/{topicSlug}',array( 'as'=>'portal_topics_view_path','uses'=>'Portal\ForumsController@getViewTopic'));

    Route::get('api/topics', array('as'=>'portal.api.topics', 'uses'=>'Portal\TopicsController@getDatatable'));
    Route::resource('topics','Portal\TopicsController');
    //member profile
    Route::get('user/profile',array('as'=>'user_profile_path','uses'=>'Portal\UserProfilesController@getUserProfile'));
    Route::get('user/profile/create',array('as'=>'user_profile_create_path','uses'=>'Portal\UserProfilesController@getCreate'));
    Route::post('user/profile/store',array('as'=>'portal.user-profile.store','uses'=>'Portal\UserProfilesController@postStore'));
    Route::get('user/profile/edit',array('as'=>'portal.user-profile.edit','uses'=>'Portal\UserProfilesController@getEdit'));
    Route::post('user/profile/update',array('as'=>'portal.user-profile.update','uses'=>'Portal\UserProfilesController@postUpdate'));
});

Route::group(array('prefix' => 'admin/api','before'=>'authAdmin'), function(){

    Route::post('categories/updateActiveStatus','Admin\Api\CategoriesController@updateActiveStatus');
    Route::get('categories/{slug}','Admin\Api\CategoriesController@getCategory');

});

Route::group(array('prefix' => 'api/v1'), function(){
    Route::get('redactor/images','Api\RedactorsController@getImages');
    Route::post('redactor/images/upload','Api\RedactorsController@uploadImage');
    Route::post('redactor/files/upload','Api\RedactorsController@uploadFile');
    Route::get('jcrop','Api\JcropsController@index');
    Route::post('jcrop/save','Api\JcropsController@postSave');

});



