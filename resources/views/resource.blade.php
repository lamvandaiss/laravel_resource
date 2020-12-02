@extends('layouts.master')
@section('content')
  <form action="/resource" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="item-form">
      <label for="">Html:</label><br>
      <textarea name="html" rows="4" cols="50"></textarea>
    </div>
    <div class="item-form">
      <label for="">Sass:</label><br>
      <textarea name="sass" rows="4" cols="50"></textarea>
    </div>
    <div class="item-form">
      <div class="set-image">
        <label for="">Images:</label><br>
        <input type="file" name="images[]" id="images" placeholder="Images" multiple  accept="image/*">
        <span id="pasteTarget" class="pasteTarget">Click and paste here.</span>
      </div>
      <div id="image_preview" class="image_preview"></div>
      <div>
        <input type="hidden" id="image_clipboard" name="image_clipboard" value="">
        <img src="#" alt="image" class="img_clipboard" id="img_clipboard">
      </div>
    </div>
    <div class="item-form">
      <label for="">Task:</label><br>
      <textarea name="task" rows="4" cols="50"></textarea>
    </div>
    <div class="item-form">
      <label for="">Category:</label><br>
      <select name="category">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>     
    <input type="submit" value="Create">
  </form> 
  <script>
  $(function() {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    window.onload = function() {
      document.getElementById("pasteTarget").
      addEventListener("paste", handlePaste);
    };
    function handlePaste(e) {
      for (var i = 0 ; i < e.clipboardData.items.length ; i++) {
        var item = e.clipboardData.items[i];
        if (item.type.indexOf("image" - 1)) {
          uploadFile(item.getAsFile());
        }
      }
    }
    // upload image by ajax
    function uploadFile(file) {
      $("#img_clipboard").attr('src', URL.createObjectURL(file));
      $("#img_clipboard").show();
      var formData = new FormData();
      formData.append('file', file);
      var token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url:"/file/resource", 
        method:"POST", 
        data: formData,
        contentType: false, 
        processData: false,
        success:function(result){ 
          var linkImg = result.url;
          $("#image_clipboard").val(linkImg);
        }
      });
    }

    function preview_image() 
    {
      var total_file=document.getElementById("images").files.length;
      $('#image_preview').empty();
      for(var i=0;i<total_file;i++)
      {
        $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'><br>");
      }
    }
    $("#images").change(function() {
      preview_image();
    });

  });
  </script>
@endsection