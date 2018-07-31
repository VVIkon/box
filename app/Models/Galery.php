<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galery extends Model
{
    use SoftDeletes;

    protected $table = 'galeries';
    protected $fillable = ['user_id', 'galery_group_id', 'url_img', 'comment'];
    protected $hidden = ['*'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;

    public function group()
    {
        return $this->belongsTo('App\Models\GaleryGroups', 'galery_group_id', 'id' );
    }
}
