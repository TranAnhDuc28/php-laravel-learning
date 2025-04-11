<div class="container">
    @foreach ($posts as $post)
        {{ $post->title }}
    @endforeach
</div>

{{ $posts->links() }}
