@extends('layouts.master')
@section('content')
    <form action="/resource" method="POST">
        @csrf
        <label for="">Html:</label><br>
        <textarea name="html" rows="4" cols="50">{{$resource->html}}</textarea><br>
        <label for="">Sass:</label><br>
        <textarea name="sass" rows="4" cols="50">{{$resource->sass}}</textarea><br>
        <label for="">Task:</label><br>
        <textarea name="task" rows="4" cols="50">{{$resource->task}}</textarea><br>
    </form>      
@endsection