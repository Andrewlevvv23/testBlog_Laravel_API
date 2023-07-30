<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// Інтерфейс завантаження по API рандомних постів та коментарів
Route::prefix('api')->group(function () {
    require __DIR__.'/api.php';
});

// Основні ресурсні контроллери CRUD-ів по постам та коментарям
Route::resource('posts',  PostController::class)->middleware(['auth.check']);
Route::resource('comments',  CommentController::class)->withTrashed();

// Стартова сторінка після аутентифікації та сторінка перегляду особистих коментарів юзера
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/user/comments', [CommentUserController::class, 'index'])->name('user.comments');

// Фільтрація постів по алфавіту та даті створення
Route::get('/posts/sort/title', [PostController::class, 'indexByTitle'])->name('posts.sort.title');
Route::get('/posts/sort/date', [PostController::class, 'indexByDate'])->name('posts.sort.date');

Auth::routes();
