<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 15.07.18
 * Time: 10:10
 */

namespace App\Helpers;


class ArrayHelper
{


//$arrs: [
//    {"id":2,"parent_id":null},
//    {"id":8,"parent_id":2},
//    {"id":6,"parent_id":2},
//    {"id":4,"parent_id":2},
//    {"id":5,"parent_id":4},
//    {"id":3,"parent_id":null},
//    {"id":7,"parent_id":null},
//    {"id":9,"parent_id":null}
//];
    /** Сортировка массива по иерархии id <- parent_id
     * @param array $arr
     * @return array
     */
    public static function hierarchicalSort(Array $arrs, $id = 'id', $parentId = 'parent_id')
    {
        $newArr = [];
        while (count($arrs) > 0){
            $el = array_shift($arrs);
            $nextInd = count($newArr);
            if(!is_null($el[$parentId])){
                foreach ($newArr as $ind=>$item){
                    if ($item[$id] == $el[$parentId] ){
                        $cnt = self::countParentInArray($newArr, $el[$parentId]);
                        $nextInd = $ind+$cnt+1;
                    }
                }
                array_splice($newArr,$nextInd,0,[$el]);

            }else{
                array_push($newArr,$el);
            }
        }
        return $newArr;
    }

    /**
     * @param $arr
     * @param $parentId
     * @return mixed
     */
    private static function countParentInArray($arr, $parentId){
        if (is_null($parentId)){
            return 0;
        }
        $cnt[$parentId]=0;
        foreach ($arr as $el) {
            if (isset($el['parent_id'])){
                if (array_key_exists($el['parent_id'],$cnt)){
                    $cnt[$el['parent_id']] ++;
                }
            }
        }

        return $cnt[$parentId];
    }

}