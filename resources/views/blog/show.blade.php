<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="description" content="{{ $post->meta->meta_description ? $post->meta->meta_description : '' }}"> --}}
    {{-- <meta name="keywords" content="{{ $post->meta->meta_keywords ? $post->meta->meta_keywords : '' }}"> --}}
    {{-- <meta name="robots" content="{{ $post->meta->meta_robots ? $post->meta->meta_robots : '' }}"> --}}
    <title>Blog</title>
</head>
<body>
    <div class="">
        <p>
            {{ $post->title }}<br>
            {{ $post->excerpt }}<br>
            {{ $post->body }}<br>
            Minute to read: {{ $post->min_to_read }}<br>
            Created at: {{ $post->created_at }}<br>
            Updated at: {{ $post->updated_at }}<br>
        </p>
        {{-- <p>
            Categories:
            @foreach ($post->categories as category)
                {{ $category }}
            @endforeach
        </p> --}}
    </div>
</body>
</html>