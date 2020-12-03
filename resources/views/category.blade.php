@extends('layouts.master')
@section('content')
    <div class="box-search">
        <input type="text" value="" id="input-search" class="form-control">
        <button id="btn-search" class="btn btn-secondary">Tìm kiếm</button>
    </div>
    <div class="loader"></div>
    <div class="div-content" id="div-content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tag</th>
                    <th>Image</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1; ?>
                @foreach ($resources as $resource)
                <tr>
                    <td>{{$stt++}}</td>
                    <td><a href="/detail-resource/{{$resource->id}}">{{$resource->tag}}</a></td>
                    <td>
                    @if($resource->images)
                        <?php 
                            $images = explode('|', $resource->images);
                        ?>
                        <img class="cate-image" src='{{$images[0]}}' alt="image">
                    @endif
                    </td>
                    <td>{{$resource->category->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                    html += '<table class="table table-bordered">';
                    html += '    <thead>';
                    html += '        <tr>';
                    html += '            <th>STT</th>';
                    html += '            <th>Tag</th>';
                    html += '            <th>Image</th>';
                    html += '            <th>Category</th>';
                    html += '        </tr>';
                    html += '    </thead>';
                    html += '    <tbody>';
                    let stt = 1;
                    for (var item of result) {
                        html += '        <tr>';
                        html += '            <td>' + stt++ + '</td>';
                        html += '            <td><a href="/detail-resource/' + item.id + '">' + item.tag + '</a></td>';
                        html += '            <td>';
                        if(item.images){
                            let images = item.images.split('|');
                            html += '             <img class="cate-image" src=' + images[0] + ' alt="image">';
                        }
                        html += '            </td>';
                        html += '            <td>' + item.category.name + '</td>';
                        html += '        </tr>';
                    }
                    html += '    </tbody>';
                    html += '</table>';
                    if(result.length == 0) {
                        html = "Không tìm thấy kết quả nào!";    
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