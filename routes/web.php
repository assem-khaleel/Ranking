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

Route::group(['prefix' => UriLocalizer::localeFromRequest()], function () {
    App::setLocale(UriLocalizer::localeFromRequest());

    Route::get('/_debugbar/assets/stylesheets', ['as' => 'debugbar-css', 'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@css']);
    Route::get('/_debugbar/assets/javascript', ['as' => 'debugbar-js', 'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@js']);
    Route::group(['middleware' => ['auth']], function () {

        Route::get('/', 'HomeController@index')->name('home');
        Route::get('getPrograms/{categoryId}', 'HomeController@getPrograms');
        Route::get('adminGetPrograms/{categoryId}/{institutionId}', 'HomeController@adminGetPrograms');

        Route::get('system-Dashboard', 'HomeController@systemDashboard')->name('home.system');
        Route::get('program-dashboard', 'HomeController@programDashboard')->name('home.programDashboard');
        Route::get('showProgramDashboard/{program_id}/{system_id}/{month}/{lang}/{year?}', 'HomeController@showProgramDashboard')->name('home.programDashboardProgress');
        Route::get('/chart', 'ChartController@index')->name('org-chart');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('program-home/{programId}/{year?}', 'HomeController@programHome')->name('home.program');
        Route::get('showProgress/{program_id}/{system_id}/{month}/{lang}/{year?}', 'HomeController@showProgress')->name('home.progress');
        Route::get('report', 'ReportController@index')->name('report.index');
        Route::get('report-show', 'ReportController@show')->name('report.show');
        Route::get('criteriaindicator/{system}/{year}/{institution?}', 'HomeController@CriteriaIndicator')->name('Criteria.Indicator');

        Route::get('program-report-show', 'ReportController@programShow')->name('report.programShow');

        Route::group(['prefix' => 'profiles', 'namespace' => 'Profiles'], function () {
            Route::get('my-profile', 'ProfileController@myProfile')->name('profiles.myProfile');
            Route::put('change-password', 'ProfileController@changePassword')->name('profiles.changePassword');
            Route::put('{id}', 'ProfileController@update')->name('profiles.update');
        });

        Route::get('ranking-result-index', 'RankingResultController@index')->name('result.index');
        Route::post('ranking-result-store', 'RankingResultController@store')->name('result.store');
        Route::get('ranking-result-year', 'RankingResultController@year')->name('result.year');
        Route::get('ranking-result-criteria', 'RankingResultController@criteria')->name('result.criteria');
        Route::get('ranking-result-ranking-system', 'RankingResultController@rankingSystem')->name('result.rankingSystem');
        Route::get('ranking-result-indicator', 'RankingResultController@indicator')->name('result.indicator');
        Route::get('ranking-result/{rankingSystem}/{criteria}/{programId}/{year}/{month}', 'RankingResultController@valueProgram');
        Route::get('ranking-result/{rankingSystem}/{criteria}/{year}/{month}', 'RankingResultController@valueInstitution');

        Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {

            Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
                Route::put('institution-user-change-password/{userId}', 'InstitutionUserController@changePassword')->name('user.changePasswordInstitution');
                Route::get('{id}/active', 'InstitutionUserController@active')->name('users.active');
                Route::get('{id}/inactive', 'InstitutionUserController@inactive')->name('users.inactive');
                Route::put('system-user-change-password/{userId}', 'SystemUserController@changePassword')->name('users.changePasswordSystem');
                Route::resource('institution-user', 'InstitutionUserController');
                Route::resource('system-user', 'SystemUserController');
            });

            Route::resource('institution', 'InstitutionController');
            Route::resource('college', 'CollegeController');
            Route::resource('department', 'DepartmentController');
            Route::get('program/progress/{id}', 'ProgramController@progress')->name('program.progress');
            Route::resource('program', 'ProgramController');
            Route::resource('ranking-system', 'RankingSystemController');
            Route::resource('ranking-criteria', 'RankingCriteriaController');
            Route::resource('ranking-indicator', 'RankingIndicatorController');
            Route::resource('category', 'SystemCategoriesController');

        });

    });
    Auth::routes();
});
