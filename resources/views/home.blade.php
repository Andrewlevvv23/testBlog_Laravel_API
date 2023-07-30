@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        {{ __('Вітаємо, ви успішно аунтифіковані!') }}
                </div>

                <a class="btn btn-primary" href="{{ route('posts.index') }}"> Перейти до перегляду блогу > </a> <br>
                <a class="btn btn-success" href="{{ route('posts.create') }}"> < Або одразу створіть свій пост  </a>
            </div>
        </div>
    </div>
</div>
@endsection
