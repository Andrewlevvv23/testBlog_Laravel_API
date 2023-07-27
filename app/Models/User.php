<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;                     //встроєний клас, який дозволяє відправляти користувачам повідомлення
    use SoftDeletes;                    //імпорт функціоналу для "мʼякого" видалення контенту за таблиці
    use HasFactory;                     //імпорт функціоналу для тестування за допомогою фабрики/сідерів

    protected $fillable = [             //вказую, які дані можна буде змінювати по 'create' та 'update'
        'name', 'email', 'password',
    ];

    protected $hidden = [               //вказую, які дані потрібно приховати, з міркувань безпеки
        'password', 'remember_token',
    ];

    public function posts()             //метод posts() "має багато" значень між поточною моделлю та моделлю Post
    {
        return $this->hasMany(Post::class);
    }

    public function comments()         //метод comments() "має багато" значень між поточною моделлю та моделлю Comment
    {
        return $this->hasMany(Comment::class);
    }

}
