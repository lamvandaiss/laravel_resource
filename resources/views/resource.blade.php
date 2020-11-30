@extends('layouts.master')
@section('content')
  <form action="/resource" method="POST">
    @csrf
    <label for="">Html:</label><br>
    <textarea name="html" rows="4" cols="50"></textarea><br>
    <label for="">Sass:</label><br>
    <textarea name="sass" rows="4" cols="50"></textarea><br>
    <label for="">Task:</label><br>
    <textarea name="task" rows="4" cols="50"></textarea><br>
    <label for="">Category:</label><br>
    <select name="category">
      @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select><br> <br>     
    <input type="submit" value="Create">
  </form> 
@endsection