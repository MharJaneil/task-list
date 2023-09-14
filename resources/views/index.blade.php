@extends('layouts.app')
@section('title','Task List')
@section('content')
<nav class="mb-4">
    <a href="{{ route('task.create') }}"
    class="link">Add Task!</a>
    
</nav>
@forelse( $tasks as $task )
    <div>
            <a href="{{ route('task.show',['task' => $task->id]) }}"
                @class(['line-through'=>$task->completed])> {{ $task->title }}</a>
    </div>
@empty
    <div>There are no task!</div>
@endforelse

@if ($tasks->count())
    <nav class="mt-4">
        {{ $tasks->links()}}
    </nav>
@endif
@endsection