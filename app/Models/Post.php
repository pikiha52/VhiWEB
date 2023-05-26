<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function post_tags()
    {
        return $this->hasMany(PostTag::class, 'post_id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by_id')->select(['id', 'name']);
    }
}
