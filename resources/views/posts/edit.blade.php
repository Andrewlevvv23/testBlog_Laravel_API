@extends('layouts.main')

@section('content')
    <div class="container">
        <h1> Редагувати пост: </h1>
        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="title" class="form-label custom-text-shadow"> Заголовок вашого поста: </label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
                <div class="form-text">Бажано на українській мові і грамотично правильно :)</div>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label custom-text-shadow"> Введіть тект вашого посту: </label>
                <textarea type="text" id="body" name="body" rows="6" class="form-control h-100"> {{ $post->body }} </textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label custom-text-shadow"> Прикрипіти новий файл: </label>
                <input class="form-control" type="file" name="file" id="file">
                <p class="ms-1 mt-1">Поточний файл: <a href="{{ asset('uploads/' . $post->file) }}">{{ $post->file }}</a></p>
            </div>
            <div class="mb-3">
                <label for="delete_file" class="custom-text-shadow"> Видалити поточний файл: </label>
                <input  type="checkbox" name="delete_file" id="delete_file">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label custom-text-shadow"> Прикріпіть нове зображення: </label>
                <input class="form-control" type="file" name="image" id="image">
            </div>
            <div class="mb-3">
                <label for="delete_image" class="custom-text-shadow"> Видалити поточне зображення: </label>
                <input type="checkbox" name="delete_image" id="delete_image">
            </div>

            <button type="submit" class="btn btn-primary"> Редагувати </button>
        </form>
    </div>
@endsection

