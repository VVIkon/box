<?php
namespace App\Models\Repository;

use App\Models\Parser;


class ParserRepository
{
    public static function getSiteAll()
    {
        return Parser::orderBy('id','DESC')->get();
    }

    public static function getSiteById($id)
    {
        $content =  Parser::where('id', $id)->first()->toArray();
        if (count($content) == 0){
            return [
                "result" => 0,
                "value" => '',
                "error" => 'Ошибка выборки из БД'
            ];
        }else{
            return [
                "result" => 1,
                "value" => $content,
                "error" => null
            ];
        }
    }

    public static function saveSite(array $params)
    {
       $parser = new Parser();
       $parser->site_url = $params['site_url'];
       $parser->parser_id = $params['parser_id'];
       $parser->site_name =  $params['site_name'];
       $parser->site_content =  $params['site_content'];
       return $parser->save();
    }
}