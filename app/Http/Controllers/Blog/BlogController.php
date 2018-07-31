<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Gate;

class BlogController extends Controller
{
    public function index()
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $message = [
            'msg'=>'Привет!',
            'cod'=> '45',
            'day'=> date("d.m.y")
        ];
        return view('blog.main',['url_message'=> $message ]);
    }
}
 