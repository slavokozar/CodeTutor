<?php


/* PRESENTATION */
Route::get('/', 'System\PresentationController@index');
Route::get('pravidla', 'System\PresentationController@rules');
Route::get('wanted', 'System\PresentationController@wanted');



/* USERS */
Route::group(['prefix' => trans('users.url'), 'namespace' => 'Users'], function () {

    Route::group(['prefix' => trans('users.schools.url'), 'namespace' => 'Schools'], function () {

        Route::group(['prefix' => '/{school}/' . trans('users.admins.url')], function () {
            Route::get('/', 'AdminController@index');
            Route::get('/' . trans('routes.create'), 'AdminController@create');
            Route::post('/', 'AdminController@store');
            Route::get('/{user}', 'AdminController@show');
            Route::get('/{user}/' . trans('routes.edit'), 'AdminController@edit');
            Route::put('/{user}/' . trans('routes.edit'), 'AdminController@update');
            Route::get('/{user}/' . trans('routes.delete'), 'AdminController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'AdminController@destroy');
        });

        Route::group(['prefix' => '/{school}/' . trans('users.teachers.url')], function () {
            Route::get('/', 'TeacherController@index');
            Route::get('/' . trans('routes.create'), 'TeacherController@create');
            Route::post('/', 'TeacherController@store');
            Route::get('/{user}', 'TeacherController@show');
            Route::get('/{user}/' . trans('routes.edit'), 'TeacherController@edit');
            Route::put('/{user}/' . trans('routes.edit'), 'TeacherController@update');
            Route::get('/{user}/' . trans('routes.delete'), 'TeacherController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'TeacherController@destroy');
        });

        Route::group(['prefix' => '/{school}/' . trans('users.students.url')], function () {
            Route::get('/', 'StudentController@index');
            Route::get('/' . trans('routes.create'), 'StudentController@create');
            Route::post('/', 'StudentController@store');
            Route::get('/{user}', 'StudentController@show');
            Route::get('/{user}/' . trans('routes.edit'), 'StudentController@edit');
            Route::put('/{user}/' . trans('routes.edit'), 'StudentController@update');
            Route::get('/{user}/' . trans('routes.delete'), 'StudentController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'StudentController@destroy');
        });

        Route::get('/', 'SchoolController@index');
        Route::get('/' . trans('routes.create'), 'SchoolController@create');
        Route::post('/', 'SchoolController@store');
        Route::get('/{school}', 'SchoolController@show');
        Route::get('/{school}/' . trans('routes.edit'), 'SchoolController@edit');
        Route::put('/{school}/' . trans('routes.edit'), 'SchoolController@update');
        Route::get('/{school}/' . trans('routes.delete'), 'SchoolController@deleteModal');
        Route::delete('/{school}/' . trans('routes.delete'), 'SchoolController@destroy');

    });

    Route::group(['prefix' => trans('users.groups.url'), 'namespace' => 'Groups'], function () {

        Route::group(['prefix' => '/{group}/' . trans('users.teachers.url')], function () {
            Route::get('/', 'TeacherController@index');
            Route::get('/' . trans('routes.create'), 'TeacherController@create');
            Route::post('/', 'TeacherController@store');
            Route::get('/{user}', 'TeacherController@show');
            Route::get('/{user}/' . trans('routes.delete'), 'TeacherController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'TeacherController@destroy');
        });

        Route::group(['prefix' => '/{group}/' . trans('users.students.url')], function () {
            Route::get('/', 'StudentController@index');
            Route::get('/' . trans('routes.create'), 'StudentController@create');
            Route::post('/', 'StudentController@store');
            Route::get('/{user}', 'StudentController@show');
            Route::get('/{user}/' . trans('routes.delete'), 'StudentController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'StudentController@destroy');
        });

        Route::get('/', 'GroupController@index');
        Route::get('/' . trans('routes.create'), 'GroupController@create');
        Route::post('/', 'GroupController@store');
        Route::get('/{group}', 'GroupController@show');
        Route::get('/{group}/' . trans('routes.edit'), 'GroupController@edit');
        Route::put('/{group}/' . trans('routes.edit'), 'GroupController@update');
        Route::get('/{group}/' . trans('routes.delete'), 'GroupController@deleteModal');
        Route::delete('/{group}/' . trans('routes.delete'), 'GroupController@destroy');
    });

    Route::group(['prefix' => trans('users.groups.url'), 'namespace' => 'Groups'], function () {

        Route::group(['prefix' => '/{groups}/' . trans('users.admins.url')], function () {
            Route::get('/', 'AdminController@index');
            Route::get('/' . trans('routes.create'), 'AdminController@create');
            Route::post('/', 'AdminController@store');
            Route::get('/{user}', 'AdminController@show');
            Route::get('/{user}/' . trans('routes.edit'), 'AdminController@edit');
            Route::put('/{user}/' . trans('routes.edit'), 'AdminController@update');
            Route::get('/{user}/' . trans('routes.delete'), 'AdminController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'AdminController@destroy');
        });

        Route::group(['prefix' => '/{groups}/' . trans('users.teachers.url')], function () {
            Route::get('/', 'TeacherController@index');
            Route::get('/' . trans('routes.create'), 'TeacherController@create');
            Route::post('/', 'TeacherController@store');
            Route::get('/{user}', 'TeacherController@show');
            Route::get('/{user}/' . trans('routes.edit'), 'TeacherController@edit');
            Route::put('/{user}/' . trans('routes.edit'), 'TeacherController@update');
            Route::get('/{user}/' . trans('routes.delete'), 'TeacherController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'TeacherController@destroy');
        });

        Route::group(['prefix' => '/{groups}/' . trans('users.students.url')], function () {
            Route::get('/', 'StudentController@index');
            Route::get('/' . trans('routes.create'), 'StudentController@create');
            Route::post('/', 'StudentController@store');
            Route::get('/{user}', 'StudentController@show');
            Route::get('/{user}/' . trans('routes.edit'), 'StudentController@edit');
            Route::put('/{user}/' . trans('routes.edit'), 'StudentController@update');
            Route::get('/{user}/' . trans('routes.delete'), 'StudentController@deleteModal');
            Route::delete('/{user}/' . trans('routes.delete'), 'StudentController@destroy');
        });

        Route::get('/', 'GroupController@index');
        Route::get('/' . trans('routes.create'), 'GroupController@create');
        Route::post('/', 'GroupController@store');
        Route::get('/{group}', 'GroupController@show');
        Route::get('/{group}/' . trans('routes.edit'), 'GroupController@edit');
        Route::put('/{group}/' . trans('routes.edit'), 'GroupController@update');
        Route::get('/{group}/' . trans('routes.delete'), 'GroupController@deleteModal');
        Route::delete('/{group}/' . trans('routes.delete'), 'GroupController@destroy');
    });

    Route::get('/', 'UserController@index');
    Route::get('/' . trans('routes.create'), 'UserController@create');
    Route::post('/', 'UserController@store');
    Route::get('/{user}', 'UserController@show');
    Route::get('/{user}/' . trans('routes.edit'), 'UserController@edit');
    Route::put('/{user}/' . trans('routes.edit'), 'UserController@update');
    Route::get('/{user}/' . trans('routes.delete'), 'UserController@deleteModal');
    Route::delete('/{user}/' . trans('routes.delete'), 'UserController@destroy');
});


/* PROFILE */
Route::group(['prefix' => trans('profile.url'), 'namespace' => 'Profile'], function () {
    Route::get('/profil/zmena-hesla', 'ProfileController@edit');
    Route::post('/profil/zmena-hesla', 'ProfileController@update');

    Route::get('/' . trans('articles.url'), 'ArticleController@index');
    Route::get('/' . trans('assignments.url'), 'AssignmentController@index');
    Route::get('/' . trans('files.url'), 'FileController@index');
    Route::get('/' . trans('links.url'), 'LinkController@index');
    Route::get('/' . trans('groups.url'), 'GroupController@index');

});


/* CONTENT */

/* LINKS */
Route::group(['prefix' => trans('links.url'), 'namespace' => 'Links'], function () {

    Route::get('/', 'LinkController@index');
    Route::get('/' . trans('routes.create'), 'LinkController@create');
    Route::post('/', 'LinkController@store');
    Route::get('/{link}', 'LinkController@show');
    Route::get('/{link}/' . trans('routes.edit'), 'LinkController@edit');
    Route::put('/{link}/' . trans('routes.edit'), 'LinkController@update');
    Route::get('/{link}/' . trans('routes.delete'), 'LinkController@deleteModal');
    Route::delete('/{link}/' . trans('routes.delete'), 'LinkController@destroy');
});

/* FILES */
Route::group(['prefix' => trans('files.url'), 'namespace' => 'Files'], function () {

    Route::get('/', 'FileController@index');
    Route::get('/' . trans('routes.create'), 'FileController@create');
    Route::post('/', 'FileController@store');
    Route::get('/{file}', 'FileController@show');
    Route::get('/{file}/' . trans('routes.edit'), 'FileController@edit');
    Route::put('/{file}/' . trans('routes.edit'), 'FileController@update');
    Route::get('/{file}/' . trans('routes.delete'), 'FileController@deleteModal');
    Route::delete('/{file}/' . trans('routes.delete'), 'FileController@destroy');
});

/* ARTICLES */
Route::group(['prefix' => trans('articles.url'), 'namespace' => 'Articles'], function () {

    Route::get('/', 'ArticleController@index');
    Route::get('/' . trans('routes.create'), 'ArticleController@create');
    Route::post('/', 'ArticleController@store');
    Route::get('/{article}', 'ArticleController@show');
    Route::get('/{article}/' . trans('routes.edit'), 'ArticleController@edit');
    Route::put('/{article}/' . trans('routes.edit'), 'ArticleController@update');
    Route::get('/{article}/' . trans('routes.delete'), 'ArticleController@deleteModal');
    Route::delete('/{article}/' . trans('routes.delete'), 'ArticleController@destroy');

    Route::get('/{article?}/' . trans('routes.images'), 'ImageController@index');
    Route::post('/{article?}/' . trans('routes.images'), 'ImageController@store');

});

/* ASSIGNMENTS */
Route::group(['prefix' => trans('assignments.url'), 'namespace' => 'Assignments'], function () {

    Route::get('/', 'AssignmentController@index');
    Route::get('/' . trans('routes.create'), 'AssignmentController@create');
    Route::post('/', 'AssignmentController@store');
    Route::get('/{assignment}', 'AssignmentController@show');
    Route::get('/{assignment}/' . trans('routes.edit'), 'AssignmentController@edit');
    Route::put('/{assignment}/' . trans('routes.edit'), 'AssignmentController@update');
    Route::get('/{assignment}/' . trans('routes.delete'), 'AssignmentController@deleteModal');
    Route::delete('/{assignment}/' . trans('routes.delete'), 'AssignmentController@destroy');

    Route::get('/{assignment?}/' . trans('routes.images'), 'ImageController@index');
    Route::post('/{assignment?}/' . trans('routes.images'), 'ImageController@store');
    
    Route::group(['prefix' => '/{assignment}/' . trans('assignments.datapub.url')], function () {
        Route::get('/', 'DatapubController@index');
        Route::get('/' . trans('routes.create'), 'DatapubController@create');
        Route::post('/', 'DatapubController@store');
        Route::get('/{number}', 'DatapubController@show');
        Route::get('/{number}/' . trans('routes.edit'), 'DatapubController@edit');
        Route::put('/{number}/' . trans('routes.edit'), 'DatapubController@update');
        Route::get('/{number}/' . trans('routes.moveDown'), 'DatapubController@moveDown');
        Route::get('/{number}/' . trans('routes.moveUp'), 'DatapubController@moveUp');
        Route::get('/{number}/' . trans('routes.delete'), 'DatapubController@deleteModal');
        Route::delete('/{number}/' . trans('routes.delete'), 'DatapubController@destroy');
    });

    Route::group(['prefix' => '/{assignment}/' . trans('assignments.datatest.url')], function () {
        Route::get('/', 'DatatestController@index');
        Route::get('/' . trans('routes.create'), 'DatatestController@create');
        Route::post('/', 'DatatestController@store');
        Route::get('/{number}', 'DatatestController@show');
        Route::get('/{number}/' . trans('routes.edit'), 'DatatestController@edit');
        Route::put('/{number}/' . trans('routes.edit'), 'DatatestController@update');
        Route::get('/{number}/' . trans('routes.moveDown'), 'DatatestController@moveDown');
        Route::get('/{number}/' . trans('routes.moveUp'), 'DatatestController@moveUp');
        Route::get('/{number}/' . trans('routes.delete'), 'DatatestController@deleteModal');
        Route::delete('/{number}/' . trans('routes.delete'), 'DatatestController@destroy');
    });


    Route::group(['prefix' => '/{assignment}/' . trans('assignments.submit.url')], function () {
        Route::get('/', 'SubmitController@index');

        Route::post('/' . trans('routes.upload'), 'SubmitController@upload');

        Route::get('/' . trans('routes.history'), 'SubmitController@history');
//        Route::get('/' . trans('routes.upload'), 'SubmitController@upload');
//        Route::get('/' . trans('routes.upload'), 'SubmitController@upload');
//        Route::get('/' . trans('routes.upload'), 'SubmitController@upload');





        Route::get('/' . trans('routes.sources') . '/{file?}', 'SubmitController@source');
//        Route::post('/', 'DatatestController@store');
//        Route::get('/{number}', 'DatatestController@show');
//        Route::get('/{number}/' . trans('routes.edit'), 'DatatestController@edit');
//        Route::put('/{number}/' . trans('routes.edit'), 'DatatestController@update');
//        Route::get('/{number}/' . trans('routes.moveDown'), 'DatatestController@moveDown');
//        Route::get('/{number}/' . trans('routes.moveUp'), 'DatatestController@moveUp');
//        Route::get('/{number}/' . trans('routes.delete'), 'DatatestController@deleteModal');
//        Route::delete('/{number}/' . trans('routes.delete'), 'DatatestController@destroy');
    });

    Route::group(['prefix' => '/{assignment}/' . trans('assignments.solutions.url')], function () {
        Route::get('/', 'SolutionController@index');
        Route::get('/{code}', 'SolutionController@show');
        Route::put('/{code}', 'SolutionController@update');
        Route::get('/{code}/source/{source}', 'SolutionController@source');
        Route::post('/{code}/source/{source}', 'SolutionController@comments');
    });



        /////* ASSIGNMENTS - tests */
////
////Route::get('zadania/{assignment}/testy/data/{data}/uprava/novy-test', 'Assignments\TestController@newTest');
////Route::get('zadania/{assignment}/testy/data/{data}/uprava/nova-uloha', 'Assignments\TestController@newTask');
////Route::get('zadania/{assignment}/testy/data/{data}/uprava/novy-riadok', 'Assignments\TestController@newLine');
////
////Route::post('zadania/{assignment}/testy/data/{data}/uprava', 'Assignments\TestController@update');
////
////Route::get('zadania/{assignment}/testy/nastavenia', 'Assignments\TestController@settings');
////Route::post('zadania/{assignment}/testy/nastavenia', 'Assignments\TestController@postSettings');
////
////Route::get('zadania/{assignment}/testy/vzorove-riesenie', 'Assignments\TestController@example');
////Route::get('zadania/{assignment}/testy/kontrola', 'Assignments\TestController@review');


    //
/////* ASSIGNMENTS - solutions */
////Route::get('zadania/{assignment}/riesenia', 'Assignments\SolutionController@index');
////
////
/////* ASSIGNMENTS - tests */
////Route::get('zadania/{assignment}/testy/data/{data}', 'Assignments\TestController@show');
////Route::get('zadania/{assignment}/testy/data/{data}/uprava', 'Assignments\TestController@edit');
////
////Route::get('zadania/{assignment}/testy/data/{data}/uprava/novy-test', 'Assignments\TestController@newTest');
////Route::get('zadania/{assignment}/testy/data/{data}/uprava/nova-uloha', 'Assignments\TestController@newTask');
////Route::get('zadania/{assignment}/testy/data/{data}/uprava/novy-riadok', 'Assignments\TestController@newLine');
////
////Route::post('zadania/{assignment}/testy/data/{data}/uprava', 'Assignments\TestController@update');
////
////Route::get('zadania/{assignment}/testy/nastavenia', 'Assignments\TestController@settings');
////Route::post('zadania/{assignment}/testy/nastavenia', 'Assignments\TestController@postSettings');
////
////Route::get('zadania/{assignment}/testy/vzorove-riesenie', 'Assignments\TestController@example');
////Route::get('zadania/{assignment}/testy/kontrola', 'Assignments\TestController@review');
////
////
/////* ASSIGNMENTS - submit */
////Route::get('zadania/{assignment}/odovzdanie', 'Assignments\SubmitController@show');
////Route::post('zadania/{assignment}/odovzdanie/upload', 'Assignments\SubmitController@upload');
////
////Route::get('zadania/{assignment}/odovzdanie/historia', 'Assignments\SubmitController@history');
//

});


/* FILES */
Route::group(['prefix' => trans('files.url'), 'namespace' => 'Files'], function () {
    Route::get(trans('files.images') . '/{image}/' . trans('files.modal-thumb'), 'ImageController@modalThumb');
    Route::get(trans('files.images') . '/{image}/' . trans('files.article-thumb'), 'ImageController@articleThumb');


    Route::delete(trans('files.images') . '/{image}', 'ImageController@delete');
});




/* COMMENTS */
Route::get('{object}/{code}/komentare', 'System\CommentController@index');
Route::get('{object}/{code}/komentare/{comment}', 'System\CommentController@create');
Route::post('{object}/{code}/komentare/{comment?}', 'System\CommentController@store');

Route::delete('komentare/{object}/{code}/{comment}', 'System\CommentController@destroy');

Route::get('komentare/{object}/{code}/{comment}/edit', 'System\CommentController@edit');
Route::post('komentare/{object}/{code}/{comment}/edit', 'System\CommentController@update');


/* AUTH */
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');


Route::get('feed', 'FeedController@index');