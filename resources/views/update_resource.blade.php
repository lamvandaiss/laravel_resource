@extends('layouts.master')
@section('content')
    @if(isset($resource))
    <form action="/update-resource" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$resource->id}}">
        <div class="form-group">
            <label for="">Tag:<span class="required-item">*</span></label><br>
            <input class="form-control" required type="text" name="tag" value="{{$resource->tag}}">
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
                <div class="bd-clipboard"><button type="button" id="copy-html" class="btn-clipboard" title="Copy to clipboard">Copy</button></div>
                <label for="">Html:<span class="required-item">*</span></label>
                <textarea id="html" class="form-control" required name="html" rows="4" cols="50">{{$resource->html}}</textarea>
            </div>
            <div class="item-form col-6 form-group">
                <div class="bd-clipboard"><button type="button" id="copy-sass" class="btn-clipboard" title="Copy to clipboard">Copy</button></div>
                <label for="">Sass:<span class="required-item">*</span></label>
                <textarea id="sass" class="form-control" required name="sass" rows="4" cols="50">{{$resource->sass}}</textarea>
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
    <script>
        $(function() {
            //Copy content to clipboard from input element by id
            function copyToClipboard(idToCopy) {
                let copyText = document.getElementById(idToCopy);
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
            }
            $("#copy-html").click(function(){
                copyToClipboard('html');
                $(this).html('Copied!');
            });
            $("#copy-html").mouseout(function(){
                $(this).html('Copy');
            });
            $("#copy-sass").click(function(){
                copyToClipboard('sass');
                $(this).html('Copied!');
            });
            $("#copy-sass").mouseout(function(){
                $(this).html('Copy');
            });
        });
    </script>  
    @endif
@endsection