@extends('layouts.master')
@section('content')
  <form action="/resource" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="">Tag:<span class="required-item">*</span></label>
      <input type="text" required class="form-control" name="tag">
    </div>
    <div class="form-group">
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
    <div class="row">    
      <div class="item-form col-6 form-group">
        <label for="">Html:<span class="required-item">*</span></label>
        <textarea name="html" required class="form-control" rows="4" cols="50"></textarea>
      </div>
      <div class="item-form col-6 form-group">
        <label for="">Sass:<span class="required-item">*</span></label>
        <textarea name="sass" required class="form-control" rows="4" cols="50"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="">Category:</label>
      <select name="category" class="form-control">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>  
    <div class="form-group div-submit">   
      <input type="submit" value="Tạo mới" class="btn btn-secondary">
      <input type="reset" value="Đặt lại" class="btn btn-secondary">
    </div> 
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