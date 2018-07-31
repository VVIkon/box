<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogChat extends Model
{
    use SoftDeletes;

    protected $table = 'blog_chat';
    protected $fillable = ['parent_id', 'blog_id', 'user_id', 'chat_comment'];
    protected $hidden = ['*'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id' );
    }

    public function blog()
    {
        return $this->belongsTo('App\Models\Blog', 'blog_id', 'id' );
    }
}
