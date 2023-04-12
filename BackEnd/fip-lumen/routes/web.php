<?php

/** @var \Laravel\Lumen\Routing\Router $router */
 

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

 


 
//localhost:8000/books/2
$router->get('gallery', ['uses' => 'GalleryController@showAllGallery']);



//localhost:8000/books
$router->get('members', ['uses' => 'MemberController@showAllMembers']);

$router->get('members/{id}', ['uses' => 'MemberController@showOneMember']);


/*----CRUD----*/

//create
$router->post('members/create', ['uses' => 'MemberController@createMember']);

//update
$router->put('members/{id}', ['uses' => 'MemberController@updateMember']);


//delete
$router->delete('members/{id}', ['uses' => 'MemberController@deleteMember']);



