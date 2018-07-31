<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\PermissionGroup;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $permissinArray = [];
    protected $fillable = ['id','name', 'email', 'password','permission_group_id','imgPath'];
    protected $hidden = ['*'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;



    public function permissionGroup()
    {
        return $this->hasOne('App\Models\PermissionGroup','id','permission_group_id');
       // $this->permission = $UserPermisionGroup->getPermissionArr();
    }

    /**
     * @return mixed
     */
    public function hasPermission($permition)
    {
        if (empty($this->permissinArray)) {
            $this->permissinArray = $this->permissionGroup->getPermissionArr();
        }
        return in_array( $permition, $this->permissinArray);
    }

}
