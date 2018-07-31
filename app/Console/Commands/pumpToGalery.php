<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Repository\GaleryRepository;
use App\Helpers\ImageHelper;
use Intervention\Image\Facades\Image;


class pumpToGalery extends Command
{
    protected $signature = 'galery:pump';
    protected $description = 'Для загрузки галереи "public/gal/"  поместите файлы *.jpg в папку "public/tmp/" и выполните php artisan galery:pump';

    private $images;
    private $dirname = 'public/tmp/';

    public function __construct()
    {
        parent::__construct();
        //загружает содержимое папки (список путей) в массив
        $this->images = glob($this->dirname."*.jpg");
    }

    //imageType:  1= GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF.
    public function handle()
    {

        GaleryRepository::truncateGalery();

        foreach($this->images as $image) {
            // Из пути к файлу создаём объект Image
            $img = Image::make($image);
            //Делает два файла: малый (превью) и большой, указанного размера в папке gal. Возвращает наименование малого файла (превью)
            $smallImage = ImageHelper::imageChangeAndSave($img,1024,768,164,164,'gal', 1);
            // Сохраняет наименование малого файла (превью) с примечанием comment
            if (GaleryRepository::loadPictureToGalery(1, 1,$smallImage, 'Александр Ктиторчук')){
                echo 'File: '.$smallImage.' - загружен'."\n";
            }
        }
    }
}
