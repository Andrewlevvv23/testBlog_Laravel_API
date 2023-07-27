<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create(Post $post)
    {
        return view('comments.create', compact('post'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'post_id' => 'numeric'
        ]);

        $comment = Comment::create([
            'body' => $request->input('body'),
            'user_id' => auth()->user()->id,
            'post_id' => $request->input('post_id'),    // Використовуємо значення post_id з запиту, а не з об'єкта $post
        ]);

        $comment->saveHistory($request->input('body'));  // Збереження історії коментаря

        return redirect()->route('posts.show', $request->input('post_id'))->with('success', 'Коментар успішно доданий.');
    }
}
