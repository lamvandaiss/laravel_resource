@extends('layouts.master')
@section('content')
    @if(isset($resource))
    <form action="/resource" method="POST">
        @csrf
        <div class="item-form">
            <label for="">Html:</label><br>
            <textarea name="html" rows="4" cols="50">{{$resource->html}}</textarea>
        </div>
        <div class="item-form">
            <label for="">Sass:</label><br>
            <textarea name="sass" rows="4" cols="50">{{$resource->sass}}</textarea>
        </div>
        @if($resource->images)
            <div class="item-form">
                <label for="">Images:</label><br>
                <div class="image_preview">
                    <?php 
                        $images = explode('|', $resource->images);
                    ?>
                    @foreach($images as $image)
                        <img src='{{$image}}' alt="image"><br>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="item-form">
            <label for="">Task:</label><br>
            <textarea name="task" rows="4" cols="50">{{$resource->task}}</textarea>
        </div>
    </form>      
    @endif
@endsection