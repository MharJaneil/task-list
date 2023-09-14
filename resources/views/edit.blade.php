@extends('layouts.app')

@section('title', 'Edit Task')
    @include('form',['task'=>$task])
@endsection
