<?php


namespace App\Http\Controllers\Galery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Gate;
use \Auth;
use App\Models\Repository\GaleryRepository;

class GaleryController extends Controller
{
    public function index()
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $userid = Auth::user()->id;
        $galeryContents = GaleryRepository::loadGaleryByUserId($userid);
        return view('galery.galery',['galeryContents'=> $galeryContents ]);
    }
}
