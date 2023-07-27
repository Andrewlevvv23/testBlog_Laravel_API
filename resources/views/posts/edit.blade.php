@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Редагувати пост: </h1>
        <form action="{{ route('posts.update', $post) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="title" class="form-label"> Заголовок вашого поста: </label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
                <div class="form-text">Бажано на українській мові і грамотично правильно :)</div>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label"> Введіть тект вашого посту: </label>
                <textarea type="text" id="body" name="body" rows="6" class="form-control h-100"> {{ $post->body }} </textarea>
            </div>
            <button type="submit" class="btn btn-primary"> Створити </button>
        </form>
    </div>
@endsection

