<div class="sidebar">
    <div class="cate"><a href="/">Category</a></div>
    @foreach ($categories as $category)
        <a href="/category/{{ $category->id }}">{{ $category->name }}</a>
    @endforeach
</div>