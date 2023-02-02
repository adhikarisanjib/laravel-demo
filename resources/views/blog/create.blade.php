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
        <form enctype="multipart/form-data" action="{{ route('blog.store')}}" method="POST">
            @csrf
            <label for="is_published">Is Published</label>
            <input name="is_published" type="checkbox"><br><br>
            <input name="min_to_read" type="number" placeholder="min_to_read"><br><br>
            <input name="title" type="text" placeholder="title"><br><br>
            <input name="excerpt" type="text" placeholder="excerpt"><br><br>
            <textarea name="body" cols="30" rows="10" placeholder="body"></textarea><br><br>
            <input name="image" type="file"><br><br>
            <input name="meta_description" type="text" placeholder="meta_description"><br><br>
            <input name="meta_keywords" type="text" placeholder="meta_keywords"><br><br>
            <input name="meta_robots" type="text" placeholder="meta_robots"><br><br>
            <input type="submit" value="Create"><br><br>
        </form>
    </div>
</body>
</html>