<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;                    //імпорт функціоналу для "мʼякого" видалення контенту за таблиці
    use HasFactory;                     //імпорт функціоналу для тестування за допомогою фабрики/сідерів
    protected $fillable = [             //вказую, які дані можна буде змінювати по 'create' та 'update'
        'title', 'body', 'user_id', 'post_id'
    ];

    public function user()              //метод user() "належить до" батьківському класу User, а саме одному значенню  звідти
    {
        return $this->belongsTo(User::class);
    }

    public function comments()          //метод comments() "має багато" значень між поточною моделлю та моделлю Comment
    {
        return $this->hasMany(Comment::class);
    }
}
