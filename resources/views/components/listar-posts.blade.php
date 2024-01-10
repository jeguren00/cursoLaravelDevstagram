<div>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
        @foreach ($posts as $post)
            <div>
                <a href="{{ route('posts.show', ['user' => $post->user ,'post' => $post ])}}">
                    <img src="{{ asset('uploads') . '/'. $post->imagen}}" alt="Imagen del post {{$post->titulo}}"/>
                </a>
            </div>
        @endforeach
    </div>
    @else
        <p class="text-center">No hay posts</p>
    @endif

</div>