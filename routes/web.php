<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'user/api/v1'], function($router) {
    $router->post('/login', 'LoginController@login');
    $router->post('/register', 'UserController@register');
    $router->get('/user', ['middleware' => 'auth', 'uses' =>  'UserController@get_user']);
});

// http://localhost/upkeep/user/api/v1/register?firstname=Vishal2&lastname=Dubey&email=vishal2.xyz@xyz.com&password=vishal@1&phone=9827012345&business_type=Facility Managment&role=1

// http://localhost/upkeep/user/api/v1/login?email=vishal2.xyz@xyz.com&password=vishal@1

// http://localhost/upkeep/user/api/v1/user