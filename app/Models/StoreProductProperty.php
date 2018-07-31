<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProductProperty extends Model
{
        use SoftDeletes;

        protected $table = 'cs_product_properties';
        protected $fillable = ['product_id', 'property_id', 'poduct_value', 'product_comment'];
        protected $hidden = ['created_at','updated_at', 'deleted_at'];
        protected $dates = ['deleted_at'];
        public $incrementing = true;
        public $timestamp = true;

        public function propertyName()
        {
            return $this->belongsTo('App\Models\StoreProperty', 'property_id', 'id' );
        }
}
