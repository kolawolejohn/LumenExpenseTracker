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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/expenseGroups', 'ExpenseGroupController@index');
$router->post('/expenseGroups', 'ExpenseGroupController@store');
$router->get('/expenseGroups/{expenseGroup}', 'ExpenseGroupController@show');
$router->put('/expenseGroups/{expenseGroup}', 'ExpenseGroupController@update');
$router->patch('/expenseGroups/{expenseGroup}', 'ExpenseGroupController@update');
$router->delete('/expenseGroups/{expenseGroup}', 'ExpenseGroupController@destroy');

$router->get('/expenses', 'ExpenseController@index');
$router->post('/expenses', 'ExpenseController@store');
$router->get('/expenses/{expense}', 'ExpenseController@show');
$router->put('/expenses/{expense}', 'ExpenseController@update');
$router->patch('/expenses/{expense}', 'ExpenseController@update');
$router->delete('/expenses/{expense}', 'ExpenseController@destroy');

$router->get('/users', 'UserController@index');
$router->post('/users', 'UserController@store');
$router->get('/users/{user}', 'UserController@show');
$router->put('/users/{user}', 'UserController@update');
$router->patch('/users/{user}', 'UserController@update');
$router->delete('/users/{user}', 'UserController@destroy');

