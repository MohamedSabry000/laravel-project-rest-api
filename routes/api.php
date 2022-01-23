<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Users
Route::get('/users', fn() => User::all());
Route::post('/users', function ()
{
    request()->validate([
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
    ]);
    return User::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => request('password')
    ]);
});

// Posts
Route::get('/posts', function ()
{
    return Post::all();
});
Route::post('/posts', function ()
{
    request()->validate([
        'title' => 'required',
        'content' => 'required'
    ]);
    return Post::create([
        'user_id' => request('user_id'),
        'cat_id' => request('cat_id'),
        'title' => request('title'),
        'content' => request('content')
    ]);
});
Route::put('/posts/{post}', function (Post $post)
{
    request()->validate([
        'title' => 'required',
        'content' => 'required'
    ]);
    $post->update([
        // 'user_id' => request('user_id'),
        // 'cat_id' => request('cat_id'),
        'title' => request('title'),
        'content' => request('content')
    ]);
});

// Categories
Route::get('/categories', fn() => Category::all());
Route::post('/categories', function () {
    request()->validate([ 'name' => 'required' ]);
    return Category::create([ 'name' => request('name') ]);
});

// Comments
Route::get('/comments', fn() => Comment::all());
Route::post('/comments', function ()
{
    request()->validate([
        'comment' => 'required'
    ]);
    return Comment::create([
        'user_id' => request('user_id'),
        'post_id' => request('post_id'),
        'comment' => request('comment'),
        'vote' => request('vote')
    ]);
});

