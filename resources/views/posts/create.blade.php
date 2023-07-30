@extends('layouts.main')

@section('content')
    <div class="container">
        <h1> Створити пост: </h1>
        <form action="{{ route('posts.store') }}" method="post"  enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label custom-text-shadow"> Заголовок вашого поста: </label>
                <input type="text" name="title" id="title" class="form-control" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Бажано на українській мові і грамотично правильно :)</div>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label custom-text-shadow"> Введіть тект вашого посту: </label>
                <textarea type="text" id="body" name="body" rows="6" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label custom-text-shadow"> Прикріпіть ваш файл: </label>
                <input class="form-control" type="file" name="file" id="file">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label custom-text-shadow"> Прикріпіть ваше зображення: </label>
                <input class="form-control" type="file" name="image" id="image">
            </div>

            <button type="submit" class="btn btn-primary"> Створити </button>
        </form>
    </div>
@endsection

