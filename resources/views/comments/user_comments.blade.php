@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <h2> Перегляд коментарів користувача -  {{ auth()->user()->name }} </h2>

            @foreach($comments as $comment)
                <div class="mt-4">
                    <h5>
                        Пост №{{ $comment->post->id }}.
                        <a href="{{route('posts.show', $comment->post->id)}}"> "{{ $comment->body }}".  </a>
                    </h5>
                        Дата створення:  {{ $comment->created_at }}<br><br>

                </div>
            @endforeach
        </div>
    </div>

@endsection
