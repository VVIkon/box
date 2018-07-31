<?php
namespace App\Models\Repository;

use App\Models\Galery;
use App\Models\GaleryGroups;


class GaleryRepository
{
    /**
     * Загрузка груп с галереями
     * @param $userId
     * @return array
     */
    public static function loadGaleryByUserId($userId)
    {
        if (! isset($userId)){
            return [];
        }
        $galery = GaleryGroups::with('galery')->where('user_id','=',$userId)->orderBy('group_name')->get();
//        $galery = GaleryGroups::with('galery')->where('user_id','=',$userId)->orderBy('created_at')->get();

        return $galery->toArray();
    }

    public static function truncateGalery()
    {
//        $galery = Galery::where('id','>',0);
        Galery::where('id','>', 0)->forceDelete();
//        $galery->delete();
    }

    public static function loadPictureToGalery($userId, $galeryGroipId, $urlImage, $comment)
    {
        $galery = new Galery();
        $galery->user_id = $userId;
        $galery->galery_group_id = $galeryGroipId;
        $galery->url_img = $urlImage;
        $galery->comment = $comment;
        return $galery->save();
    }
}