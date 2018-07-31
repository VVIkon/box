<?php

namespace App\Http\Controllers\Shop;

use App\Models\Tovar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Repository\TovarRepository;
use \Gate;

class TovarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        //$userid = Auth::user()->id;
        $tovar = TovarRepository::getTovarAll();
        return view('shop.tovar',['tovar'=> $tovar ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tovar  $tovar
     * @return \Illuminate\Http\Response
     */
    public function show(Tovar $tovar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tovar  $tovar
     * @return \Illuminate\Http\Response
     */
    public function edit(Tovar $tovar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tovar  $tovar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tovar $tovar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tovar  $tovar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tovar $tovar)
    {
        //
    }
}
