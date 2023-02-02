<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = DB::select('SELECT * FROM posts');
        // $posts = DB::select('SELECT * FROM posts WHERE id = ?', [1]);
        // $posts = DB::insert('INSERT INTO posts (title, excerpt, body, image_path, is_published, min_to_read) VALUES(?, ?, ?, ?, ?, ?)', [
        //     'Test blog', 'Test Heading', 'Test Body', 'Test url', true, 1
        // ]);
        // $posts = DB::update('UPDATE posts SET body = ? WHERE id = ?', [
        //     'Updated body', 103
        // ]);
        // $posts = DB::delete('DELETE FROM posts WHERE id = ?', [103]);

        // $posts = DB::table('posts')
            // ->select('title', 'body')
            // ->where('is_published', true)
            // ->where('id', '>', 50)
            // ->whereBetween('min_to_read', [2, 6])
            // ->whereNotBetween('min_to_read', [2, 6])
            // ->whereIn('min_to_read', [2, 6, 8])
            // ->whereNull('body')
            // ->whereNotNull('body')
            // ->select('min_to_read')->distinct()
            // ->orderBy('id', 'desc')
            // ->skip(20)->take(10)
            // ->inRandomOrder()

            // ->get();
            // ->first();
            
            // ->find(100);
            // ->where('id', 100)->value('body');
            // ->count();
            // ->where('id', '>', 50)->count();
            // ->min('min_to_read');
            // ->max('min_to_read');
            // ->sum('min_to_read');
            // ->avg('min_to_read');

        // var_dump($posts);
        // dd($posts);

        // $posts = DB::table('posts')->get();
        $posts = Post::orderBy('updated_at', 'desc')->paginate(20);

        return view("blog.home", [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $request->validated();

        // $request->validate([
        //     'title' => 'required|unique:posts|max:255',
        //     'excerpt' => 'required',
        //     'body' => 'required',
        //     'image_path' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],
        //     'min_to_read' => 'min:0|max:60',
        // ]);

        // $post = new Post();
        // $post->title = $request->title;
        // $post->excerpt = $request->excerpt;
        // $post->body = $request->body;
        // $post->min_to_read = $request->min_to_read;
        // $post->is_published = $request->is_published === 'on';
        // $post->image_path = $this->storeImage($request);
        // $post->save();

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'min_to_read' => $request->min_to_read,
            'is_published' => $request->is_published === 'on',
            'image_path' => $this->storeImage($request),
        ]);

        $post ->meta()->create([
            'post_id' => $post->id,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'meta_robots' => $request->meta_robots,
        ]);

        return redirect(route('blog.home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('blog.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('blog.edit', [
            'post' => Post::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
        $request->validated();

        // $request->validate([
        //     'title' => 'required|max:255|unique:posts,title,'.$id,
        //     'excerpt' => 'required',
        //     'body' => 'required',
        //     'image_path' => ['mimes:jpg,png,jpeg', 'max:5048'],
        //     'min_to_read' => 'min:0|max:60',
        // ]);

        Post::where('id', $id)->update($request->except([
            '_token', '_method'
        ]));

        return redirect(route('blog.home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect(route('blog.home'))->with('message', 'Post has been deleted.');
    }

    private function storeImage($request)
    {
        $newImageName = uniqid() . '_' . $request->title . '.' .$request->image->extension();
        return $request->image->move(public_path('images'), $newImageName);
    }
}
