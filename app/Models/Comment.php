<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;                    //імпорт функціоналу для "мʼякого" видалення контенту за таблиці
    use HasFactory;                     //імпорт функціоналу для тестування за допомогою фабрики/сідерів
    protected $fillable = [            //вказую, які дані можна буде змінювати по 'create' та 'update'
        'body', 'user_id', 'post_id',
    ];

    public function user()             //метод user() "належить до" батьківському класу User, а саме одному значенню звідти
    {
        return $this->belongsTo(User::class);
    }

    public function post()              //метод post() "належить до" батьківському класу Post, а саме одному значенню звідти
    {
        return $this->belongsTo(Post::class);
    }
    public function history()             //метод history() "має багато" коментарів в історії
    {
        return $this->hasMany(CommentHistory::class);
    }
    public function saveHistory($body)
    {
        $this->history()->create([
            'body' => $body,
            'user_id' => auth()->user()->id,
        ]);
    }
}
