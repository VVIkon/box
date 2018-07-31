<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 16.06.18
 * Time: 11:53
 */

namespace App\Helpers;


class curlHelper
{
    /**Запрос странички
     * @param $url
     * @return mixed|string
     */
    public static function getPageByUrl($url)
    {
        //Инициализируем сеанс
        $curl = curl_init();
        //Указываем адрес страницы
        curl_setopt($curl, CURLOPT_URL, $url);
        //Ответ сервера сохранять в переменную, а не на экран
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //Переходить по редиректам
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        //Выполняем запрос:
        $result = curl_exec($curl);
        //Отлавливаем ошибки подключения
        if ($result === false) {
            return [
                    "result" => 0,
                    "value" => '',
                    "error" => curl_error($curl)
            ];
        } else {
            return [
                'result'=> 1,
                'value'=> $result,
                "error" =>null
            ];
        }
    }

    /** POST запрос
     * @param $url
     * @param array $params
     * @return mixed|string
     */
    public static function sendPostToUrl($url, array $params)
    {
        //Инициализируем сеанс
        $curl = curl_init();
        //Указываем адрес страницы
        curl_setopt($curl, CURLOPT_URL, $url);
        //Ответ сервера сохранять в переменную, а не на экран
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //Переходить по редиректам
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        // ['field1'=>'value1', 'field2'=>'value2',]
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36');
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type:application/x-www-form-urlencoded','Content-length:91']);

        //Выполняем запрос:
        $result = curl_exec($curl);
        //Отлавливаем ошибки подключения
        if ($result === false) {
            return "ERROR: " . curl_error($curl);
        } else {
            return $result;
        }
    }
}