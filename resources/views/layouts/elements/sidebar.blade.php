<div class="sidebar">
    <div><a href="/"  class="cate">Home</a></div>
    <div class="cate">Category</div>
    @foreach ($categories as $category)
        <a href="/category/{{ $category->id }}">{{ $category->name }}</a>
    @endforeach
</div>