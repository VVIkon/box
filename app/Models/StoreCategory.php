<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreCategory extends Model
{
       use SoftDeletes;

       protected $table = 'cs_categories';
       protected $fillable = ['category_name', 'active'];
       protected $hidden = ['created_at','updated_at', 'deleted_at'];
       protected $dates = ['deleted_at'];
       public $incrementing = true;
       public $timestamp = true;

       public function product()
       {
           return $this->hasMany('App\Models\StoreProduct', 'category_id', 'id' )
               ->with('productProperty','complect');
       }
}
