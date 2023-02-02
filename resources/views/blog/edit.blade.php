<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
</head>
<body>
    <div class="">
        @if ($errors->any())
            <ul style="list-style: none;">
                @foreach ($errors->all() as $error)
                    <li style="list-style: none; color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="">
        <form enctype="multipart/form-data" action="{{ route('blog.update', $post->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <label for="is_published">Is Published</label>
            <input name="is_published" type="checkbox" {{ $post->is_published === true ? 'checked' : ''}}><br><br>
            <input name="min_to_read" type="number" value={{ $post->min_to_read }}><br><br>
            <input name="title" type="text" value={{ $post->title }}><br><br>
            <input name="excerpt" type="text" value={{ $post->excerpt }}><br><br>
            <textarea name="body" cols="30" rows="10" placeholder="body">{{ $post->body }}</textarea><br><br>
            <input name="image_path" type="file"><br><br>
            <input type="submit" value="Update"><br><br>
        </form>
    </div>
</body>
</html>