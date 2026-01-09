<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController; // ✅ Must be here

Route::get('/', function () {
    return redirect()->route('events.index');
});

Route::resource('events', EventController::class);
