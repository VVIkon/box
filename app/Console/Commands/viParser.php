<?php

namespace App\Console\Commands;

use App\Helpers\curlHelper;
use Illuminate\Console\Command;
use \phpQuery;

class viParser extends Command
{

    protected $signature = 'parser:run';

    protected $description = 'Команда парсид указанный URL';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $refs=[];
        $strUrl = 'http://box.local';

        $content = curlHelper::getPageByUrl($strUrl);

        $pQuery = phpQuery::newDocument($content);
        $links = $pQuery->find('a');//->html();
        foreach ($links as $link){
            $refs[pq($link)->text()] = pq($link)->attr('href');
        };
        //echo json_encode($refs)."\n";
        //sleep(1);
        $contentLogin = curlHelper::getPageByUrl($refs['Login']);
        $pQuery = phpQuery::newDocument($contentLogin);
        $elem = $pQuery->find('form');
        $method = pq($elem)->attr('method');
        $action = pq($elem)->attr('action');
        $elemH = $elem->find('input[type="hidden"]');
        $outArr[pq($elemH)->attr('name')]=pq($elemH)->val();
        $elemEmail = $elem->find('input#email');
        $outArr[pq($elemEmail)->attr('name')]='vvikonnikov@rambler.ru';
        $elemPassword = $elem->find('input#password');
        $outArr[pq($elemPassword)->attr('name')]='123';
        if ($method == 'POST'){
            $result = curlHelper::sendPostToUrl($action, $outArr);
        }
        echo $result.'Array:'.json_encode($outArr)."\n";
    }
}