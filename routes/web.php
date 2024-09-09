<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App/Models;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup', function(){
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password'
    ];

    if(!Auth::attempt($credentials)){
        $user = new App\Models\User();
        // $user = User::where('email', $credentials['email'])->first();

        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);

        $user->save();

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            

            $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('update-token', ['create', 'update']);
            $basicToken = $user->createToken('basic-token');

            return ($token = user()->createToken($user->email . '_Token')->plainTextToken);
        }
    }
});
