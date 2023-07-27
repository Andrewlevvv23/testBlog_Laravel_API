<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->user()->id, // Зберігаю ID поточного аутентифікованного юзера
        ]);

        return redirect()->route('posts.index')->with('success', 'Пост успешно создан.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post = Post::find($post->id);
        //dd($post);
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Пост не знайдено!');
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост видалено успішно!');
    }

    //Додаткові методи для фільтрації постів:
    public function indexByTitle()
    {
        $posts = Post::orderBy('title', 'asc')->paginate(10);
        return view('posts.index', compact('posts'));
    }
    public function indexByDate()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }
}

