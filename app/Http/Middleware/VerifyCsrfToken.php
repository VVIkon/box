<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://box.local/chat/history',
        'http://box.local/chat/writeme',
        'http://box.local/chat/users',
        'http://box.local/parser/run',
        'http://box.local/parser/load',
    ];
}
