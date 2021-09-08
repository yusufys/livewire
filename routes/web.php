<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;


Route::get('/contact-form', function () {
    return view('contact-form');
});


Route::get('/search', function () {
    return view('search');
});

Route::get('/datatables', function () {
    return view('datatables');
});
Route::get('/posts', function () {
    return view('posts');
});
Route::get('/posts/{id}', function ($id) {
    $post = Post::findOrFail($id);
    return view('post-details')->with('post', $post);
})->name('posts');
Route::get('/poll', function () {
    return view('poll');
});