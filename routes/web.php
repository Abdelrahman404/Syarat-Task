<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
  

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth', 'department-manager']], function() {


        Route::get('/', 'HomeController@index')->name('home.index');
        /**
         * Start Manager Screen
         */
        
        // Employeers Management
        Route::get('/employee-add', 'EmployeeController@create')->name('employee.add');
        Route::post('/employee-store', 'EmployeeController@store')->name('employee.store');
        Route::get('/employee-edit/{id}', 'EmployeeController@edit')->name('employee.edit');
        Route::post('/employee-update/{id}', 'EmployeeController@update')->name('employee.update');
        Route::get('/employee', 'EmployeeController@index')->name('employee.index');

        // Department Management
        Route::get('/department', 'DepartmentController@index')->name('department.index');
        Route::get('/department-create', 'DepartmentController@create')->name('department.create');
        Route::get('/department-remove/{id}', 'DepartmentController@destroy')->name('department.remove');
        Route::Post('/department-store', 'DepartmentController@store')->name('department.store');

        // Task Managment
        Route::get('/task', 'TaskController@index')->name('task.index');
        Route::get('/task-create', 'TaskController@create')->name('task.create');
        Route::Post('/task-store', 'TaskController@store')->name('task.store');
        Route::get('/task-remove/{id}', 'TaskController@destroy')->name('task.remove');
       
        /**
         * End Manager Screen
         */
     


          /**
         * End User Screen
         */
        /**
         * Logout Routes
         */
      
    });

         /**
         * Start User Screen
         */

        Route::group(['middleware' => ['auth']], function() {  
            
            Route::get('/user','UserController@index')->name('user.index');
            Route::post('/task-submit', 'UserController@submitTask')->name('task.submit');



            Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        });
      
});
