<?php

use Illuminate\Database\Seeder;

class store extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//
//        DB::table('cs_invoices')->truncate();
//        DB::table('cs_invoice_details')->truncate();
//        DB::table('cs_clients')->truncate();


//        DB::table('cs_complect_properties')->truncate();
//        DB::table('cs_complects')->truncate();
//        DB::table('cs_product_properties')->truncate();
//        DB::table('cs_properties')->truncate();
//        DB::table('cs_products')->truncate();
//        DB::table('cs_categories')->truncate();

    // properties
        DB::table('cs_properties')->insert(['id'=>1, 'property_name' => 'Состав']);
        DB::table('cs_properties')->insert(['id'=>2, 'property_name' => 'Цена']);
        DB::table('cs_properties')->insert(['id'=>3, 'property_name' => 'Размер']);
        DB::table('cs_properties')->insert(['id'=>4, 'property_name' => 'Вес']);
        DB::table('cs_properties')->insert(['id'=>5, 'property_name' => 'Картинка']);
        DB::table('cs_properties')->insert(['id'=>6, 'property_name' => 'Время доставки']);
    // category
        DB::table('cs_categories')->insert(['id'=>1, 'category_name' => 'Пицца',   'active'=>'1']);
        DB::table('cs_categories')->insert(['id'=>2, 'category_name' => 'Суши',    'active'=>'1']);
        DB::table('cs_categories')->insert(['id'=>3, 'category_name' => 'Салаты',  'active'=>'1']);
        DB::table('cs_categories')->insert(['id'=>4, 'category_name' => 'Паста',   'active'=>'1']);
        DB::table('cs_categories')->insert(['id'=>5, 'category_name' => 'Супы',    'active'=>'1']);
        DB::table('cs_categories')->insert(['id'=>6, 'category_name' => 'Гарниры', 'active'=>'1']);
        DB::table('cs_categories')->insert(['id'=>7, 'category_name' => 'Напитки', 'active'=>'1']);

    // products
        DB::table('cs_products')->insert(['id'=>1, 'article' => '11', 'product_name'=>'Болоньезе', 'category_id'=>1]);
        DB::table('cs_products')->insert(['id'=>2, 'article' => '22', 'product_name'=>'Римская',   'category_id'=>1 ]);
        DB::table('cs_products')->insert(['id'=>3, 'article' => '33', 'product_name'=>'Палермо',   'category_id'=>1 ]);
        DB::table('cs_products')->insert(['id'=>4, 'article' => '44', 'product_name'=>'Маргарита', 'category_id'=>1 ]);

        DB::table('cs_products')->insert(['id'=>5, 'article' => '55', 'product_name'=>'Суши с морским окунем',     'category_id'=>2 ]);
        DB::table('cs_products')->insert(['id'=>6, 'article' => '66', 'product_name'=>'Суши с копченым лососем',   'category_id'=>2 ]);
        DB::table('cs_products')->insert(['id'=>7, 'article' => '77', 'product_name'=>'Суши с тунцом',             'category_id'=>2 ]);
        DB::table('cs_products')->insert(['id'=>8, 'article' => '88', 'product_name'=>'Суши с осьминогом',         'category_id'=>2 ]);

        DB::table('cs_products')->insert(['id'=>9,  'article' => 'Цезарь',     'product_name'=>'Салат Цезарь',     'category_id'=>3 ]);
        DB::table('cs_products')->insert(['id'=>10, 'article' => 'Оливье',     'product_name'=>'Салат Оливье',     'category_id'=>3 ]);
        DB::table('cs_products')->insert(['id'=>11, 'article' => 'Греческий',  'product_name'=>'Салат Греческий',  'category_id'=>3 ]);
        DB::table('cs_products')->insert(['id'=>12, 'article' => 'Каприз',     'product_name'=>'Салат Каприз',     'category_id'=>3 ]);


    // products_properties
        //Пицца
        DB::table('cs_product_properties')->insert(['product_id' => 1, 'property_id'=>1, 'product_value'=>'Ветчина, говядина рубл., кур. филе, бекон с/к, пепперони, помидор, болг. перец, моцарелла, пицца-соус.' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 1, 'property_id'=>6, 'product_value'=>'1час' , 'product_comment'=>'']); // Время доставки

        DB::table('cs_product_properties')->insert(['product_id' => 2, 'property_id'=>1, 'product_value'=>'Ветчина, говядина рубл., кур. филе, бекон с/к, пепперони, помидор, болг. перец, моцарелла, пицца-соус.' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 2, 'property_id'=>6, 'product_value'=>'1час' , 'product_comment'=>'']); // Время доставки

        DB::table('cs_product_properties')->insert(['product_id' => 3, 'property_id'=>1, 'product_value'=>'Ветчина, говядина рубл., кур. филе, бекон с/к, пепперони, помидор, болг. перец, моцарелла, пицца-соус.' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 3, 'property_id'=>6, 'product_value'=>'1час' , 'product_comment'=>'']); // Время доставки

        DB::table('cs_product_properties')->insert(['product_id' => 4, 'property_id'=>1, 'product_value'=>'Ветчина, говядина рубл., кур. филе, бекон с/к, пепперони, помидор, болг. перец, моцарелла, пицца-соус.' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 4, 'property_id'=>6, 'product_value'=>'1час' , 'product_comment'=>'']); // Время доставки

        // суши
        DB::table('cs_product_properties')->insert(['product_id' => 5, 'property_id'=>1, 'product_value'=>'рис, водоросли нори, окунь' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 5, 'property_id'=>6, 'product_value'=>'30мин' , 'product_comment'=>'']); // Время доставки

        DB::table('cs_product_properties')->insert(['product_id' => 6, 'property_id'=>1, 'product_value'=>'рис, водоросли нори, копченый лосось' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 6, 'property_id'=>6, 'product_value'=>'30мин' , 'product_comment'=>'']); // Время доставки

        DB::table('cs_product_properties')->insert(['product_id' => 7, 'property_id'=>1, 'product_value'=>'рис, водоросли нори, тунец' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 7, 'property_id'=>6, 'product_value'=>'30мин' , 'product_comment'=>'']); // Время доставки

        DB::table('cs_product_properties')->insert(['product_id' => 8, 'property_id'=>1, 'product_value'=>'рис, водоросли нори, осьминог' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 8, 'property_id'=>6, 'product_value'=>'30мин' , 'product_comment'=>'']); // Время доставки

        // салаты
        DB::table('cs_product_properties')->insert(['product_id' => 9, 'property_id'=>1, 'product_value'=>'Салат, куриное филе, помидоры, гренки, соус' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 9, 'property_id'=>6, 'product_value'=>'30мин' , 'product_comment'=>'']); // Время доставки

        DB::table('cs_product_properties')->insert(['product_id' => 10, 'property_id'=>1, 'product_value'=>'Картофель, ветчина, морковь, маринованные огурцы, зеленый горошек, майонез' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 10, 'property_id'=>6, 'product_value'=>'30мин' , 'product_comment'=>'']); // Время доставки

        DB::table('cs_product_properties')->insert(['product_id' => 11, 'property_id'=>1, 'product_value'=>'Салат "Айсберг", помидоры, перец болгарский, сыр "Фетакса", оливковое масло, огурцы, маслины' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 11, 'property_id'=>6, 'product_value'=>'30мин' , 'product_comment'=>'']); // Время доставки

        DB::table('cs_product_properties')->insert(['product_id' => 12, 'property_id'=>1, 'product_value'=>'куриное филе, шампиньоны, орехи грецкие, сыр, майонез' , 'product_comment'=>'']); // Соста
        DB::table('cs_product_properties')->insert(['product_id' => 12, 'property_id'=>6, 'product_value'=>'30мин' , 'product_comment'=>'']); // Время доставки

        //Пицца
        DB::table('cs_complects')->insert(['id' =>1 , 'product_id'=>1, 'complect_name'=>'Маленькая' , 'complect_description'=>'Маленькая']); // пица 34 см
        DB::table('cs_complects')->insert(['id' =>2 , 'product_id'=>1, 'complect_name'=>'Большая' , 'complect_description'=>'Большая']); // пица 45 см
        DB::table('cs_complects')->insert(['id' =>3 , 'product_id'=>2, 'complect_name'=>'Маленькая' , 'complect_description'=>'Маленькая']); // пица 34 см
        DB::table('cs_complects')->insert(['id' =>4 , 'product_id'=>2, 'complect_name'=>'Большая' , 'complect_description'=>'Большая']); // пица 45 см
        DB::table('cs_complects')->insert(['id' =>5 , 'product_id'=>3, 'complect_name'=>'Маленькая' , 'complect_description'=>'Маленькая']); // пица 34 см
        DB::table('cs_complects')->insert(['id' =>6 , 'product_id'=>3, 'complect_name'=>'Большая' , 'complect_description'=>'Большая']); // пица 45 см
        DB::table('cs_complects')->insert(['id' =>7 , 'product_id'=>4, 'complect_name'=>'Маленькая' , 'complect_description'=>'Маленькая']); // пица 34 см
        DB::table('cs_complects')->insert(['id' =>8 , 'product_id'=>4, 'complect_name'=>'Большая' , 'complect_description'=>'Большая']); // пица 45 см
        //Суши
        DB::table('cs_complects')->insert(['id' =>9 ,  'product_id'=>5, 'complect_name'=>'Стандарт' , 'complect_description'=>'']);
        DB::table('cs_complects')->insert(['id' =>10 , 'product_id'=>6, 'complect_name'=>'Стандарт' , 'complect_description'=>'']);
        DB::table('cs_complects')->insert(['id' =>11 , 'product_id'=>7, 'complect_name'=>'Стандарт' , 'complect_description'=>'']);
        DB::table('cs_complects')->insert(['id' =>12 , 'product_id'=>8, 'complect_name'=>'Стандарт' , 'complect_description'=>'']);
        //Салаты
        DB::table('cs_complects')->insert(['id' =>13 , 'product_id'=>9,  'complect_name'=> 'Стандарт' , 'complect_description'=>'']);
        DB::table('cs_complects')->insert(['id' =>14 , 'product_id'=>9,  'complect_name'=> 'Большой' ,  'complect_description'=>'']);

        DB::table('cs_complects')->insert(['id' =>15 , 'product_id'=>10, 'complect_name'=> 'Стандарт' , 'complect_description'=>'']);
        DB::table('cs_complects')->insert(['id' =>16 , 'product_id'=>10, 'complect_name'=> 'Большой' ,  'complect_description'=>'']);

        DB::table('cs_complects')->insert(['id' =>17 , 'product_id'=>11, 'complect_name'=>'Стандарт' , 'complect_description'=>'']);
        DB::table('cs_complects')->insert(['id' =>18 , 'product_id'=>11, 'complect_name'=>'Большой' ,  'complect_description'=>'']);

        DB::table('cs_complects')->insert(['id' =>19 , 'product_id'=>12, 'complect_name'=>'Стандарт' , 'complect_description'=>'']);
        DB::table('cs_complects')->insert(['id' =>20 , 'product_id'=>12, 'complect_name'=>'Большой' ,  'complect_description'=>'']);

        // пица 34 см
        DB::table('cs_complect_properties')->insert(['complect_id'=>1, 'property_id'=>2 , 'complect_value'=>'580руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>1, 'property_id'=>3 , 'complect_value'=>'34см', 'complect_comment'=>'']);//Размер
        DB::table('cs_complect_properties')->insert(['complect_id'=>1, 'property_id'=>4 , 'complect_value'=>'700гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>1, 'property_id'=>5 , 'complect_value'=>'pizza-bolonese.jpg', 'complect_comment'=>'']);//Картинка
        // пица 45 см
        DB::table('cs_complect_properties')->insert(['complect_id'=>2, 'property_id'=>2 , 'complect_value'=>'760руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>2, 'property_id'=>3 , 'complect_value'=>'45см', 'complect_comment'=>'']);//Размер
        DB::table('cs_complect_properties')->insert(['complect_id'=>2, 'property_id'=>4 , 'complect_value'=>'900гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>2, 'property_id'=>5 , 'complect_value'=>'pizza-bolonese.jpg', 'complect_comment'=>'']);//Картинка

        // пица 34 см
        DB::table('cs_complect_properties')->insert(['complect_id'=>3, 'property_id'=>2 , 'complect_value'=>'530руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>3, 'property_id'=>3 , 'complect_value'=>'34см', 'complect_comment'=>'']);//Размер
        DB::table('cs_complect_properties')->insert(['complect_id'=>3, 'property_id'=>4 , 'complect_value'=>'700гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>3, 'property_id'=>5 , 'complect_value'=>'pizza-bolonese.jpg', 'complect_comment'=>'']);//Картинка
        // пица 45 см
        DB::table('cs_complect_properties')->insert(['complect_id'=>4, 'property_id'=>2 , 'complect_value'=>'740руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>4, 'property_id'=>3 , 'complect_value'=>'45см', 'complect_comment'=>'']);//Размер
        DB::table('cs_complect_properties')->insert(['complect_id'=>4, 'property_id'=>4 , 'complect_value'=>'900гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>4, 'property_id'=>5 , 'complect_value'=>'pizza-bolonese.jpg', 'complect_comment'=>'']);//Картинка

        // пица 34 см
        DB::table('cs_complect_properties')->insert(['complect_id'=>5, 'property_id'=>2 , 'complect_value'=>'520руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>5, 'property_id'=>3 , 'complect_value'=>'34см', 'complect_comment'=>'']);//Размер
        DB::table('cs_complect_properties')->insert(['complect_id'=>5, 'property_id'=>4 , 'complect_value'=>'700гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>5, 'property_id'=>5 , 'complect_value'=>'pizza-bolonese.jpg', 'complect_comment'=>'']);//Картинка
        // пица 45 с
        DB::table('cs_complect_properties')->insert(['complect_id'=>6, 'property_id'=>2 , 'complect_value'=>'980руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>6, 'property_id'=>3 , 'complect_value'=>'45см', 'complect_comment'=>'']);//Размер
        DB::table('cs_complect_properties')->insert(['complect_id'=>6, 'property_id'=>4 , 'complect_value'=>'900гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>6, 'property_id'=>5 , 'complect_value'=>'pizza-bolonese.jpg', 'complect_comment'=>'']);//Картинка

        // пица 34 см
        DB::table('cs_complect_properties')->insert(['complect_id'=>7, 'property_id'=>2 , 'complect_value'=>'550руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>7, 'property_id'=>3 , 'complect_value'=>'34см', 'complect_comment'=>'']);//Размер
        DB::table('cs_complect_properties')->insert(['complect_id'=>7, 'property_id'=>4 , 'complect_value'=>'700гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>7, 'property_id'=>5 , 'complect_value'=>'pizza-bolonese.jpg', 'complect_comment'=>'']);//Картинка
        // пица 45 см
        DB::table('cs_complect_properties')->insert(['complect_id'=>8, 'property_id'=>2 , 'complect_value'=>'770руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>8, 'property_id'=>3 , 'complect_value'=>'45см', 'complect_comment'=>'']);//Размер
        DB::table('cs_complect_properties')->insert(['complect_id'=>8, 'property_id'=>4 , 'complect_value'=>'900гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>8, 'property_id'=>5 , 'complect_value'=>'pizza-bolonese.jpg', 'complect_comment'=>'']);//Картинка

        //Суши
        DB::table('cs_complect_properties')->insert(['complect_id'=>9, 'property_id'=>2 , 'complect_value'=>'80руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>9, 'property_id'=>4 , 'complect_value'=>'50гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>9, 'property_id'=>5 , 'complect_value'=>'sush.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>10, 'property_id'=>2 , 'complect_value'=>'84руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>10, 'property_id'=>4 , 'complect_value'=>'40гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>10, 'property_id'=>5 , 'complect_value'=>'sush.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>11, 'property_id'=>2 , 'complect_value'=>'86руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>11, 'property_id'=>4 , 'complect_value'=>'45гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>11, 'property_id'=>5 , 'complect_value'=>'sush.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>12, 'property_id'=>2 , 'complect_value'=>'77руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>12, 'property_id'=>4 , 'complect_value'=>'55гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>12, 'property_id'=>5 , 'complect_value'=>'sush.jpg', 'complect_comment'=>'']);//Картинка

        //Салат
        DB::table('cs_complect_properties')->insert(['complect_id'=>13, 'property_id'=>2 , 'complect_value'=>'150руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>13, 'property_id'=>4 , 'complect_value'=>'200гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>13, 'property_id'=>5 , 'complect_value'=>'salat_zezar.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>14, 'property_id'=>2 , 'complect_value'=>'290руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>14, 'property_id'=>4 , 'complect_value'=>'400гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>14, 'property_id'=>5 , 'complect_value'=>'salat_zezar.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>15, 'property_id'=>2 , 'complect_value'=>'150руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>15, 'property_id'=>4 , 'complect_value'=>'200гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>15, 'property_id'=>5 , 'complect_value'=>'salat_frantch.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>16, 'property_id'=>2 , 'complect_value'=>'290руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>16, 'property_id'=>4 , 'complect_value'=>'400гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>16, 'property_id'=>5 , 'complect_value'=>'salat_frantch.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>17, 'property_id'=>2 , 'complect_value'=>'150руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>17, 'property_id'=>4 , 'complect_value'=>'200гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>17, 'property_id'=>5 , 'complect_value'=>'salat_greek.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>18, 'property_id'=>2 , 'complect_value'=>'290руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>18, 'property_id'=>4 , 'complect_value'=>'400гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>18, 'property_id'=>5 , 'complect_value'=>'salat_greek.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>19, 'property_id'=>2 , 'complect_value'=>'150руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>19, 'property_id'=>4 , 'complect_value'=>'200гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>19, 'property_id'=>5 , 'complect_value'=>'salat_stupit.jpg', 'complect_comment'=>'']);//Картинка

        DB::table('cs_complect_properties')->insert(['complect_id'=>20, 'property_id'=>2 , 'complect_value'=>'290руб', 'complect_comment'=>'']);//Цена
        DB::table('cs_complect_properties')->insert(['complect_id'=>20, 'property_id'=>4 , 'complect_value'=>'400гр', 'complect_comment'=>'']);//Вес
        DB::table('cs_complect_properties')->insert(['complect_id'=>20, 'property_id'=>5 , 'complect_value'=>'salat_stupit.jpg', 'complect_comment'=>'']);//Картинка
    }
}
