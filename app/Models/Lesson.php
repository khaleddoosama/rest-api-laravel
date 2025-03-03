<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['body', 'title', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
//select * from users join lesson on users.user_id=lesson.user_id

    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'lesson_tags');
    }

}