<?php


/* PROPAGATION */
Route::get('/', 'System\PropagationController@home');
Route::get('pravidla', 'System\PropagationController@rules');
Route::get('wanted', 'System\PropagationController@wanted');


/* USERS */
Route::group(['prefix' => trans('users.url'), 'namespace' => 'Users'], function () {
    Route::get('/', 'UserController@index');

    Route::group(['prefix' => trans('users.schools.url'), 'namespace' => 'Schools'], function () {
        Route::get('/', 'SchoolController@index');
        Route::get('/{school}', 'SchoolController@show');

        Route::group(['prefix' => '/{school}/' . trans('users.admins.url')], function () {
            Route::get('/', 'AdminController@index');
            Route::get('/' . trans('routes.create'), 'AdminController@create');
            Route::post('/', 'AdminController@store');
            Route::get('/{user}', 'AdminController@show');
            Route::get('/{user}/' . trans('routes.edit'), 'AdminController@edit');
            Route::put('/{user}/' . trans('routes.edit'), 'AdminController@update');
            Route::get('/{user}/' . trans('routes.delete'), 'AdminController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'AdminController@delete');
        });

        Route::group(['prefix' => '/{school}/' . trans('users.teachers.url')], function () {
            Route::get('/', 'TeacherController@index');
            Route::get('/' . trans('routes.create'), 'TeacherController@create');
            Route::post('/', 'TeacherController@store');
            Route::get('/{user}', 'TeacherController@show');
            Route::get('/{user}/' . trans('routes.edit'), 'TeacherController@edit');
            Route::put('/{user}/' . trans('routes.edit'), 'TeacherController@update');
            Route::get('/{user}/' . trans('routes.delete'), 'TeacherController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'TeacherController@delete');
        });

        Route::group(['prefix' => '/{school}/' . trans('users.students.url')], function () {
            Route::get('/', 'StudentController@index');
            Route::get('/' . trans('routes.create'), 'StudentController@create');
            Route::post('/', 'StudentController@store');
            Route::get('/{user}', 'StudentController@show');
            Route::get('/{user}/' . trans('routes.edit'), 'StudentController@edit');
            Route::put('/{user}/' . trans('routes.edit'), 'StudentController@update');
            Route::get('/{user}/' . trans('routes.delete'), 'StudentController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'StudentController@delete');
        });

    });

});




//Route::get(trans('users.url').'/'.trans('users.schools.url').'/{code}'.,'Users\Schools\SchoolController@show');


//Route::get(trans('users.url').'/'.trans('users.schools.url'),'Users\SchoolController@index');

//Route::get(trans('users.url') . '/' . trans('users.groups.url'), 'Users\GroupController@index');

/* PROFILE */
//Route::get('/uzivatel/skupiny', 'Profile\ProfileController@groups');
//
//Route::get('/uzivatel/zmena-hesla', 'Profile\ProfileController@edit');
//Route::post('/uzivatel/zmena-hesla', 'Profile\ProfileController@update');

/* GROUPS */
//Route::resource('skupiny', 'Users\GroupController');
//Route::get('skupiny/{skupina}/zadania', 'Users\GroupController@assignments');


/* ASSIGNMENTS */
Route::get('zadania', 'Assignments\AssignmentController@index');

Route::get('zadania/nove', 'Assignments\AssignmentController@create');
Route::post('zadania/nove', 'Assignments\AssignmentController@store');

Route::get('zadania/{assignment}', 'Assignments\AssignmentController@show');

Route::get('zadania/{assignment}/uprava', 'Assignments\AssignmentController@edit');
Route::post('zadania/{assignment}/uprava', 'Assignments\AssignmentController@update');

Route::get('zadania/{assignment}/odstranenie', 'Assignments\AssignmentController@remove');
Route::post('zadania/{assignment}/odstranenie', 'Assignments\AssignmentController@delete');


///* ASSIGNMENTS - solutions */
//Route::get('zadania/{assignment}/riesenia', 'Assignments\SolutionController@index');
//
//
///* ASSIGNMENTS - tests */
//Route::get('zadania/{assignment}/testy/data/{data}', 'Assignments\TestController@show');
//Route::get('zadania/{assignment}/testy/data/{data}/uprava', 'Assignments\TestController@edit');
//
//Route::get('zadania/{assignment}/testy/data/{data}/uprava/novy-test', 'Assignments\TestController@newTest');
//Route::get('zadania/{assignment}/testy/data/{data}/uprava/nova-uloha', 'Assignments\TestController@newTask');
//Route::get('zadania/{assignment}/testy/data/{data}/uprava/novy-riadok', 'Assignments\TestController@newLine');
//
//Route::post('zadania/{assignment}/testy/data/{data}/uprava', 'Assignments\TestController@update');
//
//Route::get('zadania/{assignment}/testy/nastavenia', 'Assignments\TestController@settings');
//Route::post('zadania/{assignment}/testy/nastavenia', 'Assignments\TestController@postSettings');
//
//Route::get('zadania/{assignment}/testy/vzorove-riesenie', 'Assignments\TestController@example');
//Route::get('zadania/{assignment}/testy/kontrola', 'Assignments\TestController@review');
//
//
///* ASSIGNMENTS - submit */
//Route::get('zadania/{assignment}/odovzdanie', 'Assignments\SubmitController@show');
//Route::post('zadania/{assignment}/odovzdanie/upload', 'Assignments\SubmitController@upload');
//
//Route::get('zadania/{assignment}/odovzdanie/historia', 'Assignments\SubmitController@history');

/* ARTICLES */
Route::get('clanky', 'Articles\ArticleController@index');

Route::get('clanky/vytvorenie', 'Articles\ArticleController@create');
Route::post('clanky', 'Articles\ArticleController@store');

Route::get('clanky/{article}', 'Articles\ArticleController@show');

Route::get('clanky/{article}/uprava', 'Articles\ArticleController@edit');
Route::post('clanky/{article}/uprava', 'Articles\ArticleController@update');

Route::get('clanky/{article}/odstranenie', 'Articles\ArticleController@delete');
Route::post('clanky/{article}/odstranenie', 'Articles\ArticleController@destroy');

//
///* COMMENTS */
//Route::get('{object}/{code}/komentare', 'System\CommentController@index');
//
//Route::get('{object}/{code}/komentare/{comment}', 'System\CommentController@create');
//Route::post('{object}/{code}/komentare/{comment?}', 'System\CommentController@store');
//
//Route::delete('komentare/{object}/{code}/{comment}', 'System\CommentController@destroy');
//
//Route::get('komentare/{object}/{code}/{comment}/edit', 'System\CommentController@edit');
//Route::post('komentare/{object}/{code}/{comment}/edit', 'System\CommentController@update');
//

/* AUTH */
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

