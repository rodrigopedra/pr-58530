<?php

use App\Models\User;
use App\Notifications\SampleNotification;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'notifications' => DatabaseNotification::query()->latest()->take(10)->get(),
    ]);
});

Route::post('/', function () {
    $user = User::query()->firstOrCreate([
        'email' => 'test@example.com',
    ], [
        'name' => 'Test User',
    ]);

    Notification::send($user, new SampleNotification(\request('message')));

    return back()->with('message', 'Notification sent: ' . now()->toDateTimeString());
});
