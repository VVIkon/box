<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreComplectProperty extends Model
{
        use SoftDeletes;

        protected $table = 'cs_complect_properties';
        protected $fillable = ['complect_id', 'property_id', 'complect_value', 'complect_comment'];
        protected $hidden = ['created_at','updated_at', 'deleted_at'];
        protected $dates = ['deleted_at'];
        public $incrementing = true;
        public $timestamp = true;

    public function propertyName()
    {
        return $this->belongsTo('App\Models\StoreProperty', 'property_id', 'id' );
    }
    public function product()
    {
        return $this->belongsTo('App\Models\StoreComplect', 'complect_id', 'id' );
    }

}
