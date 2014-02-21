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

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
Route::model('hotel', 'Hotel');
Route::model('ticket', 'Ticket');
Route::model('userpic', 'Userpic');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('hotel', '[0-9]+');
Route::pattern('ticket', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');
Route::pattern('userpic', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Ticket Management
    Route::get('tickets/{ticket}/show', 'AdminTicketsController@getShow');
    Route::get('tickets/{ticket}/edit', 'AdminTicketsController@getEdit');
    Route::post('tickets/{ticket}/edit', 'AdminTicketsController@postEdit');
    Route::get('tickets/{ticket}/delete', 'AdminTicketsController@getDelete');
    Route::post('tickets/{ticket}/delete', 'AdminTicketsController@postDelete');
    Route::controller('tickets', 'AdminTicketsController');
    # Hotel Management
    Route::get('hotels/{hotel}/show', 'AdminHotelsController@getShow');
    Route::get('hotels/{hotel}/edit', 'AdminHotelsController@getEdit');
    Route::post('hotels/{hotel}/edit', 'AdminHotelsController@postEdit');
    Route::get('hotels/{hotel}/delete', 'AdminHotelsController@getDelete');
    Route::post('hotels/{hotel}/delete', 'AdminHotelsController@postDelete');
    Route::controller('hotels', 'AdminHotelsController');
	
    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete');
    Route::controller('blogs', 'AdminBlogsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

//酒店
Route::get('hotel/index','HotelController@getIndex');
Route::get('hotel/{id}','HotelController@getView');
//机票
//用户攻略
Route::get('travel/{travel}/post', function(){
		return View::make('fiji/travel/create_edit');
});

Route::get('travel/addmark','TravelController@addMark');
Route::get('travel/submark','TravelController@subMark');

Route::get('travel/index','TravelController@getIndex');
Route::get('travel/{travel}/show','TravelController@getShow');
Route::get('travel/user/album/data', 'UserpicController@getAlbumData');
Route::post('travel/user/album/upload', 'UserpicController@postAlbumData');
Route::controller('travel','TravelController');
//攻略赞
//留言板
//用户相册
Route::get('user/album', 'UserpicController@getAlbum');
Route::post('user/album', 'UserpicController@postAlbum');
//用户
Route::get('user/show/{id}', 'UserController@getUserShow');
Route::post('user/show/{id}', 'UserController@postUserShow');
Route::get('user/list', 'UserController@getUserList');//获取用户列表，用户模型应该增加选择首页展示字段。
// User reset routes
Route::get('user/info','UserController@getInfo');
Route::post('user/info','UserController@postInfo');
Route::get('user/avatar','UserController@getAvatar');
Route::post('user/avatar','UserController@postAvatar');
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::get('user/set','UserController@getEdit');
Route::post('user/set','UserController@postEdit');
//Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('post/{postSlug}', 'BlogController@getView');
Route::post('post/{postSlug}', 'BlogController@postView');


Route::get('ticket/index','TicketController@getIndex');
Route::get('ticket/{id}','TicketController@getView');


# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'IndexController@getIndex'));
