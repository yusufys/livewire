<?php

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
