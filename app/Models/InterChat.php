<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class InterChat extends Model
{
    use SoftDeletes;

    protected $table = 'inter_chat';
    protected $fillable = ['user_id', 'for_user_id', 'user_message',];
    protected $hidden = ['*'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id' );
    }

    public function forUser()
    {
        return $this->belongsTo('App\User', 'for_user_id', 'id' );
    }
}
