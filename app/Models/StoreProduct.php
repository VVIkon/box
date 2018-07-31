<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProduct extends Model
{
    use SoftDeletes;

    protected $table = 'cs_products';
    protected $fillable = ['article', 'product_name'];
    protected $hidden = ['created_at','updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;

    public function productProperty()
    {
        return $this->hasMany('App\Models\StoreProductProperty', 'product_id', 'id' )->with('propertyName');
    }


    public function complect()
    {
        return $this->hasMany('App\Models\StoreComplect', 'product_id', 'id' )->with('complectProperty');
    }

}
