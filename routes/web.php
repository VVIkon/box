<?php


Route::view('/store/categories/{any}', 'store.index')->where('any', '.*');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'chat'], function(){
    Route::get('/', ['as'=>'chat.index', 'uses'=>'Chat\ChatController@index',]);
    Route::post('history', ['as'=>'chat.history', 'uses'=>'Chat\ChatController@history',]);
    Route::post('writeme', ['as'=>'chat.write.me', 'uses'=>'Chat\ChatController@writeme',]);

    Route::get('/users', ['as'=>'chat.users', 'uses'=>'Chat\ChatController@users',]);
    Route::post('/users', ['as'=>'chat.user.save', 'uses'=>'Chat\ChatController@saveUser',]);
});

Route::group(['prefix'=>'pic'], function(){
    Route::get('/', ['as'=>'pic.index', 'uses'=>'Galery\GaleryController@index',]);
});

//// Заталкивание данных в уведомления
//Route::get('pushdata', function(){
//    $data = [
//        'topic_id'=>'onNewData',
//        'data'=>'Пишет...'
//    ];
//    \App\Notifications\Socket\Pusher::sendDataToServer($data);
//});


Route::group(['prefix'=>'admin'], function(){
    Route::get('dashboard',         ['as' => 'admin.dashboard','uses' => 'Adm\AdminController@index',]);
// Пользователи
    Route::get('user-list',         ['as' => 'admin.user.list', 'uses' => 'Adm\AdminController@userList',]);

    Route::get('users',             ['as' => 'admin.users', 'uses' => 'Adm\AdminController@users',]);
    Route::get('user/edit/{id}',    ['as' => 'user.edit',   'uses' => 'Adm\AdminController@userEdit',]);
    Route::delete('user/delete',    ['as' => 'user.delete', 'uses' => 'Adm\AdminController@userDelete',]);
    Route::get('user/new',          ['as' => 'user.new',    'uses' => 'Adm\AdminController@userNew',]);
    Route::post('user/save',        ['as' => 'user.save',   'uses' => 'Adm\AdminController@userSave',]);
// Привелегии
    Route::get('permissions',             ['as' => 'admin.permissions', 'uses' => 'Adm\AdminController@permissions',]);
    Route::get('permissions/edit/{id}',   ['as' => 'perm.edit',         'uses' => 'Adm\AdminController@permissionEdit',]);
    Route::delete('permission/delete',    ['as' => 'perm.delete',       'uses' => 'Adm\AdminController@permissionDelete',]);
    Route::get('permissons/new',          ['as' => 'perm.new',          'uses' => 'Adm\AdminController@permissionNew',]);
    Route::post('permissons/save',        ['as' => 'perm.save',         'uses' => 'Adm\AdminController@permissionSave',]);

// Группы привелегий
    Route::get('permissiongroups',              ['as' => 'admin.permissionGroups',  'uses' => 'Adm\AdminController@permissionGroups',]);
    Route::get('permissiongroup/edit/{id}',     ['as' => 'permGoup.edit',           'uses' => 'Adm\AdminController@permissionGroupEdit',]);
    Route::delete('permissiongroup/delete',     ['as' => 'permGoup.delete',         'uses' => 'Adm\AdminController@permissionGroupDelete',]);
    Route::get('permissongroup/new',            ['as' => 'permGoup.new',            'uses' => 'Adm\AdminController@permissionGroupNew',]);
    Route::post('permissongroup/save',          ['as' => 'permGoup.save',           'uses' => 'Adm\AdminController@permissionGroupSave',]);
//Blog
    Route::get('blogs',  ['as' => 'admin.blogs',  'uses' => 'Adm\AdminController@blogs',]);
    Route::get('bloglst',  ['as' => 'admin.bloglst',  'uses' => 'Adm\AdminController@bloglst',]);
    Route::get('blog/{id}',  ['as' => 'admin.blog',  'uses' => 'Adm\AdminController@blog',]);
    Route::post('blog',  ['as' => 'admin.blog',  'uses' => 'Adm\AdminController@saveBlog',]);
    Route::post('blog-delete',  ['as' => 'admin.blog-delete',  'uses' => 'Adm\AdminController@deleteBlog',]);

    Route::get('blog-chats/{blogid}',  ['as' => 'admin.blog',  'uses' => 'Adm\AdminController@loadBlogWithChat',]);
    Route::get('blog-chats-load/{blogid}',  ['as' => 'admin.blog',  'uses' => 'Adm\AdminController@loadChat',]);
    Route::post('blog-chat-save',  ['as' => 'admin.chat',  'uses' => 'Adm\AdminController@saveBlogChat',]);
    Route::post('blog-chat-delete',  ['as' => 'admin.blog-delete',  'uses' => 'Adm\AdminController@deleteBlogChat',]);
});

// Парсер сайтов
Route::group(['prefix'=>'parser'], function(){
    Route::get('/', ['as'=>'parser.index', 'uses'=>'Parser\ParserController@index',]);
    Route::post('/run', ['as'=>'parser.run', 'uses'=>'Parser\ParserController@run',]);
    Route::post('/load', ['as'=>'parser.load', 'uses'=>'Parser\ParserController@loadSite',]);
});
// Блог - фасад
Route::group(['prefix'=>'blog'], function() {
    Route::get('/', ['as' => 'blog.index', 'uses' => 'Blog\BlogController@index',]);

});


// Магазин (API: molehole)
Route::group(['prefix'=>'store'], function() {
    Route::get('/', ['as' => 'store.index', 'uses' => 'Store\StoreController@index',]);

});