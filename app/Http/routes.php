<?php

use App\Task;
use Illuminate\Http\Request;

Route::get('tasks', 'TasksController@index')->name('tasks.index');
Route::get('tasks/{task}', 'TasksController@show')->name('task.id');
Route::post('tasks', 'TasksController@store')->name('task.store');
Route::put('tasks/{task}', 'TasksController@update')->name('task.update');
Route::delete('tasks/{task}', 'TasksController@delete')->name('task.delete');