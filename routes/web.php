<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    User::create([
        'name' => 'nasfmwe',
        'email' => 'emaafswil',
        'password' => 'passafwword',
    ]);

    $users = User::all();

    return response()->json($users);
});

Route::post('/submit', function () {
    // $data = request()->validate([
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|string|email|max:255|unique:users,email',
    //     'password' => 'required|string|min:8|confirmed',
    //     'password_confirmation' => 'required_with:password|same:password|min:8|string',
    // ]);

    // User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password']),
    // ]);
    echo 'aff';

    return 'done';
});

Route::put('/update', function () {
    return 'This is a PUT request!';
});

Route::delete('/delete', function () {
    return 'This is a DELETE request!';
});

Route::get('/user/{id}', function ($id) {
    return 'User ID: ' . $id;
});


