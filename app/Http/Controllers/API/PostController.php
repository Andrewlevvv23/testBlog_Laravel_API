<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Отримую дані з API
        $client = new Client();
        $response = $client->get('https://jsonplaceholder.typicode.com/posts');
        $posts = json_decode($response->getBody());

        // Зберігаю ці дані у БД
        foreach ($posts as $post) {
            Post::updateOrCreate([
                'id' => $post->id,
            ], [
                'title' => $post->title,
                'body' => $post->body,
                'user_id' => $post->userId,
            ]);
        }

        // Завантаження постів з БД і передача їх у шаблони вʼюшки
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
}
