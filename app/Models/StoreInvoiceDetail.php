<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreInvoiceDetail extends Model
{
    use SoftDeletes;

    protected $table = 'cs_invoice_details';
    protected $fillable = ['invoice_id', 'complect_id', 'kolvo', 'price', 'detail_comment'];
    protected $hidden = ['created_at','updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;

    public function invoice()
    {
        return $this->belongsTo('App\Models\StoreInvoice', 'invoice_id', 'id' );
    }

    public function complect()
    {
        return $this->belongsTo('App\Models\StoreComplect', 'complect_id', 'id' );
    }


}
