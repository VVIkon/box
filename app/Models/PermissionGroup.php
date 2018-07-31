<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\Console\Helper\Helper;

class PermissionGroup extends Model
{

    use SoftDeletes;

    protected $table = 'permission_groups';
    protected $fillable = ['name', 'comment', 'permission_arr',];
    protected $hidden = ['*'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;



    public function getPermissionArr()
    {
        if (is_null($this->permission_arr) || strlen($this->permission_arr) === 0){
            return [];
        }else{
            return explode(',',$this->permission_arr);
        }
    }


}
