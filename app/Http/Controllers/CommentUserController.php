<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentUserController extends Controller
{

    public function index()         //отримую всі коментарі аунтефікованного юзера по його ID
    {
        $user = auth()->user();
        $comments = $user->comments;
        return view('comments.user_comments', compact('comments'));
    }

}
