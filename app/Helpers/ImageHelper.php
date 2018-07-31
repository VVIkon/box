<?php

namespace App\Helpers;

//use Faker\Provider\File;
//use Faker\Provider\Image;
use Intervention\Image\ImageManager as ImgManager;
use Intervention\Image\Facades\Image;

class ImageHelper
{
    public static function imageChangeAndSave($imgFile, $bigWidth = 1024, $bigHeight = 768, $cmallWidth = 100, $cmallHeight = 60, $storagePath = 'upload', $typeFilePostfics = 0)
    {
        if (!isset($imgFile)){
            return 'user_64x64.png'; //Аватарка пустышка, если не выбрана картинка на фронте
        }

        if(!is_file($imgFile) && is_string($imgFile)){
            $imgFile = Image::make($imgFile);
        }

        $fileName = null;
        $pathToSave = public_path() . '/'.$storagePath.'/';


        $fName = str_random(20);
        try{
            $fExtension = $imgFile->getClientOriginalExtension() ?? 'jpg';
        }catch (\Exception $e){
            $fExtension ='jpg';
        }

        $manager = new ImgManager(['driver' => 'gd']);
        if ($typeFilePostfics == 0){
            $fileName = $fName.'_'.$bigWidth.'x'.$bigHeight.'.'.$fExtension;
        }else{
            $fileName = $fName.'_b.'.$fExtension;
        }

        $img = $manager->make($imgFile);
        $img->resize($bigWidth, $bigHeight,function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save($pathToSave.$fileName);

        if ($typeFilePostfics == 0) {
            $fileName = $fName . '_' . $cmallWidth . 'x' . $cmallHeight . $fExtension;
        }else{
            $fileName = $fName.'_s.'.$fExtension;
        }

        $img_mini = $manager->make($imgFile);
        $img_mini->resize($cmallWidth, $cmallHeight,function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img_mini->save($pathToSave.$fileName);

        return $fileName; // Маленький размер
    }
}