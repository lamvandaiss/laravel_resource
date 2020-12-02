@extends('layouts.master')
@section('content')
    <div class="box-search">
        <input type="text" value="" id="input-search">
        <button id="btn-search">Tìm kiếm</button>
    </div>
    <div class="loader"></div>
    <div class="div-content" id="div-content">
    @foreach ($resources as $resource)
        <form>
            <label for="">Html:</label><br>
            <textarea name="html" rows="4" cols="50">{{$resource->html}}</textarea><br>
            <label for="">Sass:</label><br>
            <textarea name="sass" rows="4" cols="50">{{$resource->sass}}</textarea><br>
            <label for="">Task:</label><br>
            <textarea name="task" rows="4" cols="50">{{$resource->task}}</textarea><br>
        </form> 
        <hr>
    @endforeach
    </div>
    <script>
        $(function() {
            function search() {
                $(".loader").show();
                var searchTxt = $("#input-search").val();
                $.ajax({
                method: "GET",
                url: "/search",
                data: { searchTxt: searchTxt}
                }).done(function( result ) {
                    $(".loader").hide();
                    var html = "";
                    if(result.length == 0) {
                        html = "Không tìm thấy kết quả nào!";    
                    }
                    for (var item of result) {
                        html += '<form>';
                        html += '<label for="">Html:</label><br>';
                        html += '<textarea name="html" rows="4" cols="50">'+ item.html +'</textarea><br>';
                        html += '<label for="">Sass:</label><br>';
                        html += '<textarea name="sass" rows="4" cols="50">'+ item.sass +'</textarea><br>';
                        html += '<label for="">Task:</label><br>';
                        html += '<textarea name="task" rows="4" cols="50">'+ item.task +'</textarea><br>';
                        html += '</form>'; 
                        html += '<hr>';
                    }
                    $("#div-content").html(html);
                });
            }
            $("#input-search").keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    search();
                }
            });
            $("#btn-search").click(function() {
                search();
            });
        });
    </script>
@endsection