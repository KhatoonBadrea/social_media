<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'category_id',
        'user_id'
    ];
    public function category()
    {
        return $this->belongsto(Category::class, 'category_id', 'id');
    }

    public function comments() 
    {
         return $this->hasMany(Comment::class);
    }
    public function user()
    {
        return $this->belongsto(User::class, 'user_id', 'id');
    }


}
