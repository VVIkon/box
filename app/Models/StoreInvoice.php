<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreInvoice extends Model
{
    use SoftDeletes;

    protected $table = 'cs_invoices';
    protected $fillable = ['invoice_number', 'client_id', 'operation_id', 'status_id', 'total', 'delivery_date', 'delivery_address', 'comment', 'created_at'];
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;


    public $operation = [
        0=>'удалён',
        1=>'приход',
        2=>'расход',
        3=>'перемещение',
        4=>'возврат',
        ];
    public $status = [
        0=>'новый',
        1=>'комплектация заказа',
        2=>'доставка',
        3=>'оплачен',
        4=>'закрыт',
        5=>'проблема',
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\StoreClient', 'client_id', 'id' );
    }

    public function invoiceDetails()
    {
        return $this->hasMany('App\Models\StoreInvoiceDetail', 'invoice_id', 'id' );
    }

}
