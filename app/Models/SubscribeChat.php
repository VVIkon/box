<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class SubscribeChat extends Model
{
    use SoftDeletes;

    protected $table = 'chat_subscribe';
    protected $fillable = ['user_id', 'subscribe_user_id','comment',];
    protected $hidden = ['*'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;



    public function user()
    {
//        return $this->hasOne('App\User','id','subscribe_user_id');
        return $this->belongsTo('App\User', 'subscribe_user_id', 'id' );
    }

    public function getSubscribeUsers()
    {
        return $this->user->name;
    }
}
