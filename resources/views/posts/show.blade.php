@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->body }}</p>
                <p class="custom-text-shadow">Дата публікації: {{ $post->created_at }}</p>
            </div>
            @if ($post->file)
                <p class="ms-3 custom-text-shadow">Прикріплений файл: <a href="{{ asset('uploads/' . $post->file) }}">{{ $post->file }}</a></p>
            @endif
            @if ($post->image)
                <img class="ms-3 mb-3" src="{{ url($post->image) }}" alt="Зображення не знайдено" width="200">
            @else
                <p class="ms-3">Зображення не прикріплено...</p>
            @endif
        </div>
        <h2 class="mt-4">Комментарі користувачів:</h2>
        <ul>
            @foreach($post->comments as $comment)
               <span class="text-primary"> {{ $comment->user->name }} </span> - "{{ $comment->body }}" <br><br>
            @endforeach
        </ul>

        <form action="{{ route('comments.store', $post) }}" method="post">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-3">
                <label for="body" class="form-label custom-text-shadow"> Текст вашого коментаря: </label>
                <textarea type="text" name="body" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary me-4"> Створити </button>
        </form>
    </div>

@endsection
