<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <style type="text/css"></style>
    </head>
    <body>
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
    </body>
</html>
