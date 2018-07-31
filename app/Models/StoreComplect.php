<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreComplect extends Model
{
        use SoftDeletes;

        protected $table = 'cs_complects';
        protected $fillable = ['product_id', 'complect_name', 'complect_description'];
        protected $hidden = ['created_at','updated_at', 'deleted_at'];
        protected $dates = ['deleted_at'];
        public $incrementing = true;
        public $timestamp = true;


    public function complectProperty()
    {
        return $this->hasMany('App\Models\StoreComplectProperty', 'complect_id', 'id' )->with('propertyName');
    }
}
