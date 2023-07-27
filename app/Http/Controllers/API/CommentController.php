<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use GuzzleHttp\Client;

class CommentController extends Controller
{
    public function index()
    {
        // Отримання даних з API
        $client = new Client();
        $response = $client->get('https://jsonplaceholder.typicode.com/comments');
        $comments = json_decode($response->getBody());

        // Збереження даних в БД
        foreach ($comments as $comment) {
            Comment::updateOrCreate([
                'id' => $comment->id,
            ], [
                'body' => $comment->body,
                'post_id' => $comment->postId,
                'user_id' => mt_rand(1, 10), //ставлю рандомне значення id юзера, так як даного поля немає в jsonplaceholder
            ]);
        }

        // Завантаження коментарів із БД та передача у вʼюшки
        $comments = Comment::all();
        return view('posts.show', compact('comments'));
    }
}
