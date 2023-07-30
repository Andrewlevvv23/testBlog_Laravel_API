@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-4">Список постів користувачів:</h1>
        <div class="row">
            <div class="col-6 justify-content-between">
                <a class="btn btn-primary me-4" href="{{ route('user.comments') }}">Переглянути свою історію коментарів</a>
                <a class="btn btn-success" href="{{ route('posts.create') }}">Створити новий пост</a>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <a class="btn btn-outline-dark me-2" href="{{ route('posts.sort.title') }}">Сортировати по алфавіту</a>
                <a class="btn btn-outline-dark" href="{{ route('posts.sort.date') }}">Сортувати по даті створення</a>
            </div>
        </div>

        @foreach($posts as $post)
            <div class="card mt-3">
                <div class="card-header">
                    Пост № {{ $post->id }}.
                </div>
                <div class="card-body">
                    <h5 class="card-title custom-text-shadow"> - {{ $post->title }} </h5>
                    <div class="row">
                        <div class="col-md-10">
                            <p class="card-text"> {{ $post->body }} </p>
                        </div>
                        @if ($post->image)
                            <div class="col-md-2">
                                <img src="{{ asset($post->image) }}" alt="Зображення поста" width="200" class="img-thumbnail">
                            </div>
                        @endif
                    </div>
                    <a href="{{route('posts.show', $post->id)}}" class="btn btn-primary m-2"> Переглянути пост </a>
                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-success m-2"> Редагувати пост </a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="btn m-1">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"> Видалити пост </button>
                    </form>
                </div>
            </div>
        @endforeach


        <div class="mt-4 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>

@endsection

