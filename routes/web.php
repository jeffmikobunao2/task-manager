<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Redirect the root URL straight to the task list
Route::redirect('/', '/tasks');

// Full CRUD (index, create, store, edit, update, destroy) in one line
Route::resource('tasks', TaskController::class);

// Extra route just for the Pending/Completed quick toggle
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus');
