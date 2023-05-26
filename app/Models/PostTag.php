<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class, 'id');
    }

    public function tags()
    {
        return $this->hasOne(Tag::class, 'id', 'tag_id')->select(['id','name']);
    }
}
