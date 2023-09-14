<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect()->route('task.index');
});

Route::get('/tasks', function () {
    return view ('index',[
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('task.index');

Route::view('/tasks/create', 'create')
->name('task.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view ('edit',[
        'task' => $task
    ]);
})->name('task.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view ('show',[
        'task' => $task
    ]);
})->name('task.show');

Route::post('/tasks', function (TaskRequest $request) {

    $task = Task::create($request->validated());

    return redirect()->route('task.show', ['task' => $task->id])
    ->with('success','Task Created Successfully!');
})->name('task.store');

Route::put('/tasks/{task}/edit', function (Task $task, TaskRequest $request) {

    $task->update($request->validated());

    return redirect()->route('task.show', ['task' => $task->id])
    ->with('success','Task Updated Successfully!');
})->name('task.update');

Route::put('/tasks/{task}/toggle-complete', function(Task $task) {

    $task->toggleComplete();

    return redirect()->back()->with('success','Task Updated Successfully');
})->name('task.complete');

Route::delete('/task/{task}', function (Task $task){
    $task->delete();
    return redirect()->route('task.index')
    ->with('success', 'Task Delete Succesfully');
})->name('task.destroy');

