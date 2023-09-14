@extends('layouts.app')
@section('title', $task->title.'!')
@section('content')
    
    <div class="mb-4">
        <a href="{{ route('task.index') }}"
        class="link">Go back to the task list!</a>
    </div>
    <p class="mb-4 text-slate-700">{{ $task->description }}</p>
    @if ($task->long_description)
        <p class="mb-4 text-slate-700" >{{ $task->long_description}}</p>
    @endif
    <p class="mb-4 text-sm text-slate-500">Created {{ $task->created_at->diffForHumans() }} - Updated {{ $task->updated_at->diffForHumans() }}</p>
    <div class="mb-4">
        @if ($task->completed)
        <span class="font-medium text-green-500">Completed</span>
        @else
        <span class="font-medium text-red-500">Not Completed</span>
        @endif
    </div>
    <div class="flex gap-2">
        <a href="{{ route('task.edit',['task'=> $task]) }}"
            class="btn">Edit</a>
        <form action="{{ route('task.complete', ['task'=> $task] )}}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn">
                Mark as {{ $task->completed ? 'Not Completed' : 'Completed'}}
            </button>
        </form>
        <form action=" {{ route('task.destroy',['task'=>$task])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Delete</button>

        </form>
    </div>
@endsection