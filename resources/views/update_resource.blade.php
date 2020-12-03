@extends('layouts.master')
@section('content')
    @if(isset($resource))
    <form action="/update-resource" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$resource->id}}">
        <div class="form-group">
            <label for="">Tag:</label><br>
            <input class="form-control" type="text" name="tag" value="{{$resource->tag}}">
        </div>
        @if($resource->images)
            <div class="form-group">
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
        <div class="row">
            <div class="item-form col-6 form-group">
                <label for="">Html:</label><br>
                <textarea class="form-control" name="html" rows="4" cols="50">{{$resource->html}}</textarea>
            </div>
            <div class="item-form col-6 form-group">
                <label for="">Sass:</label><br>
                <textarea class="form-control" name="sass" rows="4" cols="50">{{$resource->sass}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="">Category:</label>
            <select name="category" class="form-control">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if($category->id == $resource->category_id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>  
        <div class="form-group div-submit">   
            <input type="submit" value="Cập nhật" class="btn btn-secondary">
        </div> 
    </form>      
    @endif
@endsection