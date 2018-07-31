<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Repository\StoreRepository;
use \Gate;

class StoreController extends Controller
{
    public function index()
    {
//        if(Gate::denies('open.home')){
//            return redirect('/');
//        }

        return view('store.index');
    }

    public function loadClassificator()
    {
        return StoreRepository::loadAllCategory();
    }

    public function getCategory()
    {
        return StoreRepository::getCategory();
    }


    public function getProductList($id)
    {
//        if(Gate::denies('open.home')){
//            return redirect('/');
//        }

        $store = StoreRepository::loadProductList($id);
        return $store;
    }

    public function addClient(Request $request)
    {
//        if(Gate::denies('open.home')){
//            return redirect('/');
//        }
        $params = $request->all();

        $store = StoreRepository::addNewClient($params);
        return $store;
    }
}
