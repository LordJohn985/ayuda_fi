<?php

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

Route::get('/', 'PublicationsController@getHome');





Route::group(['middleware' => 'checkRole'], function () {



    #                               BEGIN PUBLICATIONS                               #
    Route::get('dashboard/publications/list','PublicationsController@getListPublication');
    Route::get('dashboard/publications/edit/{id}','PublicationsController@getUpdatePublication');
    Route::post('dashboard/publications/edit/','PublicationsController@postUpdatePublication');
    Route::get('dashboard/publications/delete/{id}','PublicationsController@getDeletePublication');
    Route::get('dashboard/publications/selectCandidate/{user_id}/{publication_id}','PublicationsController@getSelectCandidate');
    #                               END   PUBLICATIONS                               #



    #                               BEGIN CATEGORIES                               #
    Route::get('dashboard/categories/list','CategoriesController@getListCategory');
    Route::get('dashboard/categories/create','CategoriesController@getCreateCategory');
    Route::post('dashboard/categories/create/','CategoriesController@postCreateCategory');
    Route::get('dashboard/categories/edit/{id}','CategoriesController@getUpdateCategory');
    Route::post('dashboard/categories/edit/{id}','CategoriesController@postUpdateCategory');
    Route::get('dashboard/categories/delete/{id}','CategoriesController@getDeleteCategory');
    #                               END   CATEGORIES                               #



    #                               BEGIN USERS                               #
    Route::get('dashboard/users/list','UsersController@getListUser');
    Route::get('dashboard/users/create','UsersController@getCreateUser');
    Route::post('dashboard/users/create','UsersController@postCreateUser');
    Route::get('dashboard/users/delete/{id}','UsersController@getDeleteUser');
    #                               END   USERS                               #


    #                               BEGIN REPUTATIONS                           #
    Route::get('reputations',"ReputationsController@getListReputations");
    Route::get('reputations/create',"ReputationsController@getCreateReputation");
    Route::post('reputations/create',"ReputationsController@postCreateReputation");
    Route::get('reputations/edit/{id}','ReputationsController@getEditReputation');
    Route::post('reputations/edit/{id}',"ReputationsController@postEditReputation");
    Route::get('reputations/delete/{id}',"ReputationsController@getDeleteReputation");
    #                               END REPUTATIONS#


    #                               BEGIN LOGS                               #
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    #                               END   LOGS                               #

});

Route::group(['middleware' => 'auth'], function () {

    Route::post('dashboard/publications/aply/{id}', 'PublicationsController@postAplyPublication');
    Route::post('dashboard/publications/rate/{id}', 'PublicationsController@postRateCandidate');
    Route::get('dashboard/publications/create','PublicationsController@getCreatePublication');
    Route::post('dashboard/publications/create/','PublicationsController@postCreatePublication');
    Route::get('dashboard/users/buyCredits', 'UsersController@getBuyCredits');
    Route::post('dashboard/users/buyCredits', 'UsersController@postBuyCredits');
    Route::get('/user/edit/{id}','UsersController@getUpdateUser');
    Route::post('/user/edit/{id}','UsersController@postUpdateUser');
    Route::get('dashboard/users/edit/{id}','UsersController@getUpdateUser');
    Route::post('dashboard/users/edit/{id}','UsersController@postUpdateUser');

    Route::post('questions/ask/{id}','QuestionsController@postCreateQuestion');
    Route::post('questions/answer/{id}','QuestionsController@postAnswerQuestion');

});



#                               BEGIN PUBLIC ROUTES                               #
##PAGES
Route::get('/home', 'HomeController@index');
Route::get('/about-us', 'HomeController@getAboutUs');
Route::get('/contact-us', 'HomeController@getContactUs');
Route::get('/news', 'HomeController@getNews');
Route::get('/user/{id}','UsersController@getShowUser');
Route::get('/user','UsersController@emptyUser');


##PUBLICATIONS
Route::get('publications/list/','PublicationsController@getListPublication');
Route::get('publications/show/{id}','PublicationsController@getShowPublication');
Route::get('dashboard/publications/show/{id}','PublicationsController@getShowPublication');
Route::get('dashboard/publications/filter', 'PublicationsController@getFilterPublication');
Route::post('dashboard/publications/filter', 'PublicationsController@postFilterPublication');
Route::get('dashboard/publications/unfilter', 'PublicationsController@getUnfilterPublication');
Route::post('dashboard/publications/unfilter', 'PublicationsController@postUnfilterPublication');

#                               END   PUBLIC ROUTES                               #

Auth::routes();


