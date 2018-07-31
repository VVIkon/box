<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 18.07.18
 * Time: 12:23
 */

namespace App\Models\Repository;
use App\Models\StoreClient;
use App\Models\StoreProduct;
use App\Models\StoreCategory;


class StoreRepository
{
    /**
     * Весь классификатор с товарами
     * @return array
     */
    public static function loadAllCategory()
    {
        $result = StoreCategory::with('product')
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();
        return $result;
    }

    /**
     * Категории
     * @return array
     */
    public static function getCategory()
    {
        $result = StoreCategory::where('active',1)->orderBy('id', 'ASC')->get()->toArray();
        return $result;
    }


    /**
     * Товары категории
     * @param $categoryId
     * @return array
     */
    public static function loadProductList($categoryId)
    {
        $result = StoreProduct::with('productProperty', 'complect')
            ->where('category_id','=', $categoryId)
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();
        return $result;
    }

    /**
     * Добавление нового клиента
     * @param $params
     */
    public static function addNewClient($params)
    {
        if(isset($params['id'])){
            $model = StoreClient::where('id','=',$params['id'])->first();
        }else(
            $model = new StoreClient()
        );
        $model->nick_name = $params['nick_name'];
        $model->fio = $params['fio'];
        $model->address = $params['address'];
        $model->phone = $params['phone'];
        $model->email = $params['email'];
        $model->psw = $params['psw'];
        $model->comment = $params['comment'];

        $res =  $model->save();
        return ['result'=>$res, 'id'=>$model->id];
    }
}