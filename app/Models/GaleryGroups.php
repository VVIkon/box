<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GaleryGroups extends Model
{
    use SoftDeletes;

    protected $table = 'galery_groups';
    protected $fillable = ['user_id','group_name', 'group_comment',];
    protected $hidden = ['*'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;

    public function galery()
    {
        return $this->hasMany('App\Models\Galery', 'galery_group_id', 'id' )->orderBy('id');
    }
}
