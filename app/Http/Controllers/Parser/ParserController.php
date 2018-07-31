<?php

namespace App\Http\Controllers\Parser;

use App\Models\Repository\ParserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Gate;
use phpQuery;
use App\Helpers\curlHelper;

class ParserController extends Controller
{
    /**
     * Главная страница, выводит список пропарсенных сайтов
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        //$userid = Auth::user()->id;
        $parSites = ParserRepository::getSiteAll();
        return view('parser.main',['parSites'=> $parSites ]);
    }



    /**
     * Выполнение парсинга
     *
     * @return \Illuminate\Http\Response
     */
    public function run(Request $request)
    {
//        if(Gate::denies('open.home')){
//            return redirect('/');
//        }

        $toURL = $request->url;
        $fromUrl = curlHelper::getPageByUrl($toURL);
        if($fromUrl['result'] ==0){
            return json_encode(["status"=> 0, 'error'=>$fromUrl['error'] ]);
        }
        $pQuery = phpQuery::newDocument($fromUrl['value']);
        $content = $pQuery->html();
        $t = $pQuery->find('title');
        $title = pq($t)->text();

        $res = ParserRepository::saveSite([
                    'site_url'=> $toURL,
                    'parser_id'=> null,
                    'site_name'=>$title,
                    'site_content'=> $content
                ]);

        return json_encode(["status"=> $res]);
    }

    /**
     * Загрузка парсировки по id.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loadSite(Request $request)
    {
        $toId = $request->id;
        $res = ParserRepository::getSiteById($toId);
        return json_encode($res);
    }


}
