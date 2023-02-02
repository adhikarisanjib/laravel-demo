<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>

    <style>
        svg {
            padding: 0;
            bottom: 0;
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
    <div class="">
        <p>
            @if (Auth::user())
            <a href="{{ route('blog.create') }}">Add New Post</a>
            @endif
        </p>

        @if (session()->has('message'))
            <div style="color: red">{{ session()->get('message') }}</div>
        @endif

        @forelse ($posts as $post)
        <p>
            <a href="{{ route('blog.show', $post->id) }}">{{ $post->title }}</a><br>
            {{ $post->excerpt }}<br>
            {{ $post->body }}<br>
            {{ $post->min_to_read }}<br>
            {{ $post->created_at }}<br>
            Post by: {{ $post->user->name }}<br>

            @if (Auth::id() === $post->user->id)   
                <a href="{{ route('blog.edit', $post->id) }}">Update</a>
                <form action="{{ route('blog.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="delete">
                </form>
            @endif
        </p>
        @empty
            <p>No posts available </p>        
        @endforelse
    </div>
    <div class="mx-auto pb-10 w-4/5">
        {{ $posts->links() }}
    </div>
</body>
</html>