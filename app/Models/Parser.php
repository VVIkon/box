<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parser extends Model
{
    use SoftDeletes;

    protected $table = 'parsers';
    protected $fillable = ['id','parser_id','site_url', 'site_name', 'site_content', ];
    protected $hidden = ['*'];
    protected $dates = ['deleted_at'];
    public $incrementing = true;
    public $timestamp = true;
}
