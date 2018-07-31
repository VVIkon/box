<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProperty extends Model
{
        use SoftDeletes;

        protected $table = 'cs_properties';
        protected $fillable = ['property_name'];
        protected $hidden = ['created_at','updated_at', 'deleted_at'];
        protected $dates = ['deleted_at'];
        public $incrementing = true;
        public $timestamp = true;
}
