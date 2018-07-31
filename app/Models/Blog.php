<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = 'blogs';
    protected $fillable = ['blog_header', 'blog_img', 'bolg_content', 'blog_hashtags'];
    protected $hidden = ['*'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;

    public function blogChat()
    {
        return $this->hasMany('App\Models\BlogChat', 'blog_id', 'id' )->with('user')->orderBy('id', 'ASC','parent_id');
    }

    public function user()
    {
        return $this->belongsToMany('App\User', 'blog_chat', 'user_id', 'id' );
    }
}
