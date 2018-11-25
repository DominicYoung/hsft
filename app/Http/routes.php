<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'Home\IndexController@index');
Route::get('/list/{id}', 'Home\IndexController@news');
Route::get('/detail/{band}/{title}','Home\IndexController@detail');

Route::get('/band/{key}','Home\IndexController@band');
Route::get('/{band}/{country}/bandlist','Home\IndexController@bandlist');
Route::get('/article/{id}','Home\IndexController@article' );
Route::get('/search/{searchkey}','Home\IndexController@search' );


Route::group(['prefix' => 'admin','namespace'=>'Admin'], function () {

    Route::get('login','LoginController@index');
//    Route::get('session','LoginController@test');
    Route::post('login/check','LoginController@check');
    Route::get('logout','LoginController@logout');
    Route::group(['middleware'=>['admin.login']],function(){
//    Route::group([],function(){


        Route::get('news/index','NewsController@index');
        Route::get('news/getList','NewsController@getList');
        Route::get('news/create','NewsController@create');
        Route::post('news/store','NewsController@store');
        Route::get('news/edit/{id}','NewsController@edit');
        Route::post('news/update/{id}','NewsController@update');
        Route::get('news/del/{id}','NewsController@destroy');


        Route::get('banner/index','BannerController@index');
        Route::get('banner/getList','BannerController@getList');
        Route::get('banner/create','BannerController@create');
        Route::post('banner/store','BannerController@store');
        Route::get('banner/edit/{id}','BannerController@edit');
        Route::post('banner/update/{id}','BannerController@update');
        Route::get('banner/del/{id}','BannerController@destroy');

        Route::get('admin/index','AdminController@index');
        Route::get('admin/getList','AdminController@getList');
        Route::get('admin/create','AdminController@create');
        Route::post('admin/store','AdminController@store');
        Route::get('admin/edit/{id}','AdminController@edit');
        Route::post('admin/update/{id}','AdminController@update');
        Route::get('admin/del/{id}','AdminController@destroy');

        Route::get('sys/index','SystemController@index');
        Route::get('sys/getList','SystemController@getList');
        Route::get('sys/create','SystemController@create');
        Route::post('sys/store','SystemController@store');
        Route::get('sys/edit/{id}','SystemController@edit');
        Route::post('sys/update/{id}','SystemController@update');
        Route::get('sys/del/{id}','SystemController@destroy');

        Route::get('band/index','BandController@index');
        Route::get('band/getList','BandController@getList');
        Route::get('band/create','BandController@create');
        Route::post('band/store','BandController@store');
        Route::get('band/edit/{id}','BandController@edit');
        Route::post('band/update/{id}','BandController@update');
        Route::get('band/del/{id}','BandController@destroy');

        Route::get('/category','CategoryController@index');
        Route::get('/category/add','CategoryController@create');
        Route::get('/category/edit/{id}','CategoryController@edit');
        Route::post('/category/update/{id}','CategoryController@update');
        Route::post('/category/store','CategoryController@store');
        Route::get('/category/del/{id}','CategoryController@destroy');

        Route::post('/upload', function()
        {
            return Plupload::receive('file', function ($file)
            {
                $file->move(public_path() . '/plupload/', $file->getClientOriginalName());

                return '/plupload/'.$file->getClientOriginalName();
            });
        });
    });
//    Route::get('test',function(){
//        $info=App\Game::find(1);
//        $arr=$info->toArray();
//        unset($arr['id']);
//        for($i=0;$i<80;$i++){
//            $s=$arr;
//            $s['title']=$arr['title'].$i;
//            $s['nickname']=$arr['nickname'].$i;
//            App\Game::insert($s);
//        }
//    });
//    Route::get('test',function(){
//
//       $s= PhpSms::make()->to('18951778753')->template('YunTongXun', '1')->data(['12345', 5])->send(config('laravel-sms.queue'));
//        dd($s);
//    });

});