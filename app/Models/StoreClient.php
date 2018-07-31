<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreClient extends Model
{
        use SoftDeletes;

        protected $table = 'cs_clients';
        protected $fillable = ['nick_name', 'fio', 'address', 'phone', 'email', 'psw', 'comment'];
        protected $hidden = ['created_at','updated_at', 'deleted_at'];
        protected $dates = ['deleted_at'];
        public $incrementing = true;
        public $timestamp = true;


}
