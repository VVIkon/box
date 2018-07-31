<?php

namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Repository\BlogRepository;
use App\User;
use \Gate;
use \DB;
use Illuminate\Http\Request;
use App\Console\Commands\Users\SaveUser;
use App\Models\Blog;
use App\Helpers\ImageHelper;

//use Intervention\Image\ImageManager as ImgManager;



class AdminController extends Controller
{
    public function index()
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        return view('adm/adminDashboard');
    }

    public function users()
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        $users = User::orderBy('name', 'ASC')->get();
        $params = [
            'header'=> 'Пользователи',
            'users'=>$users,
        ];

        return view('adm/adminUsers',$params);
    }



    public function userEdit($id)
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        if (isset($id)){
            $userEd = User::with('permissionGroup')->find($id);
            $userEd->password = null;
            $permissionGroups = PermissionGroup::all()->toArray();
            $params = [
                'headerForm'=>'Изменение реквизитов пользователя',
                'routePost' =>'user.save',
                'dataset'=>$userEd,
                'fields'=>[
                    ['fieldName'=>'id', 'label'=>'id', 'type'=>'hidden', 'placeholder'=>''],
                    ['fieldName'=>'name', 'label'=>'ФИО', 'type'=>'text', 'placeholder'=>'ФИО',],
                    ['fieldName'=>'email', 'label'=>'eMail', 'type'=>'email', 'placeholder'=>'eMail',],
                    ['fieldName'=>'password', 'label'=>'Пароль', 'type'=>'password', 'placeholder'=>'',],
                    ['fieldName'=>'permission_group_id', 'label'=>'Группа привелегий', 'type'=>'select', 'placeholder'=>'','selections'=>$permissionGroups],
                    ['fieldName'=>'imgPath', 'label'=>'Аватар', 'type'=>'file', 'placeholder'=>'',],
                ],
            ];
            return view('adm/adminUserEdit',$params);
        }

    }

    public function userNew()
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }

        $permissionGroups = PermissionGroup::all()->toArray();

        $userNew = new User;
        $params = [
            'headerForm'=>'Новый пользователь',
            'routePost' =>'user.save',
            'dataset'=>$userNew,
            'fields'=>[
                ['fieldName'=>'id', 'label'=>'id', 'type'=>'hidden', 'placeholder'=>''],
                ['fieldName'=>'name', 'label'=>'ФИО', 'type'=>'text', 'placeholder'=>'ФИО',],
                ['fieldName'=>'email', 'label'=>'eMail', 'type'=>'email', 'placeholder'=>'eMail',],
                ['fieldName'=>'password', 'label'=>'Пароль', 'type'=>'password', 'placeholder'=>'',],
                ['fieldName'=>'permission_group_id', 'label'=>'Группа привелегий', 'type'=>'select', 'placeholder'=>'','selections'=>$permissionGroups],
                ['fieldName'=>'imgPath', 'label'=>'Аватар', 'type'=>'file', 'placeholder'=>'',],
            ],
        ];
        return view('adm/adminUserEdit',$params);

    }

    public function userDelete(Request $request)
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        if (isset($request->userId)){
            $usersDel = User::find($request->userId);
            $usersDel->delete();
        }
        $users = User::all();
        $params = [
            'users'=>$users,
        ];
        return view('adm/adminUsers',$params);
    }

    /**
     * @param Request $request
     */
    public function userSave(Request $request)
    {
        $insertMode = is_null($request->id);
        $this->validate($request, [
                'name' => 'required',
                'email' => $insertMode ? 'required|unique:users|max:255': 'required|max:255',
                'permission_group_id' => 'required',
                //'imgPath' => 'required',
            ],
            [
                'required'=>'Поле ":attribute" должно быть заполнено',
                'unique'=>'Поле :attribute должно быть уникальным',
                'max:255'=>'Поле :attribute должно быть заполнено',
            ],
    [
                'name' => 'ФИО',
                'email' => 'eMail',
                'permission_group_id' => 'Группа привелегий',
                //'imgPath' => 'Аватар'
            ]
        );

        if ($insertMode){
            $user = new User;
        }else{
            $user = User::find($request->id);
        }

        $this->dispatch( new SaveUser($user, $request) );
        return redirect()->route('admin.users');
    }

    public function userList()
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        $users = User::orderBy('name', 'ASC')->get()->toArray();
        return $users;
    }

// *************** Permissions *******************************


    public function permissions()
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        $permissions = Permission::orderBy('name')->get();
        $params = ['header'=> 'Привелегии',
            'permissions'=>$permissions,
        ];
        return view('adm/adminPermissions',$params);
    }

    public function permissionEdit($id)
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        if (isset($id)){
            $permEd = Permission::find($id);
            return view('adm/adminPermissionEdit',['permission'=>$permEd]);
        }
    }

    public function permissionNew()
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        $permNew = new Permission;
        return view('adm/adminPermissionEdit',['pemission'=>$permNew]);
    }

    public function permissionDelete(Request $request)
    {

        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        if (isset($request->permissionId)){
            $usersDel = User::find($request->permissionId);
            $usersDel->delete();
        }
        $permissions = Permission::all();
        return view('adm/adminPermissions',['permissions'=>$permissions]);
    }

// *************** PermissionGroups *******************************

    public function permissionGroups()
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        $permissionGroup = PermissionGroup::orderBy('name', 'ASC')->get();
        $params = [
            'header'=> 'Группы привелегий',
            'permissionGroups'=>$permissionGroup,
        ];

        return view('adm/adminPermissionGroups',$params);
    }

    public function permissionGroupEdit($id)
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }

        $permGrNew = PermissionGroup::find($id);
        $permissions = Permission::all(['id', 'name','comment'])->toArray();
        $permission_arr = $permGrNew->getPermissionArr();
        foreach ($permissions as &$permission){
            $permission['checked'] = '';
            if (in_array($permission['id'], $permission_arr)){
                $permission['checked'] = 'checked';
            }
        }
        $recordDeleted = isset($permGrNew->detete_at)?'checked':'';
        $params = [
            'headerForm'=>'Изменение группы привелегий',
            'routePost' =>'permGoup.save',
            'dataset'=>$permGrNew,
            'fields'=>[
                ['fieldName'=>'id', 'label'=>'id', 'type'=>'hidden', 'placeholder'=>''],
                ['fieldName'=>'name', 'label'=>'ФИО', 'type'=>'text', 'placeholder'=>'ФИО',],
                ['fieldName'=>'comment', 'label'=>'Описание', 'type'=>'text', 'placeholder'=>'Описание',],
                ['fieldName'=>'permission_arr', 'label'=>'Доступные привелегии', 'type'=>'checkbox','selections'=>$permissions,],
//                ['fieldName'=>'deleted_at', 'label'=>'Группа удалена', 'type'=>'delete_at', 'flag'=>$recordDeleted,],
            ],
        ];
        return view('adm/adminPermissionGroupEdit',$params);

    }

    public function permissionGroupNew()
    {
        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        $permGrNew = new PermissionGroup;
        $permGrNew->permission_arr = '';
        $permissions = Permission::all(['id', 'name','comment'])->toArray();
        $permission_arr = $permGrNew->getPermissionArr();
        foreach ($permissions as &$permission){
            $permission['checked'] = '';
            if (in_array($permission['id'], $permission_arr)){
                $permission['checked'] = 'checked';
            }
        }
        $recordDeleted = isset($permGrNew->detete_at)?'checked':'';
        $params = [
            'headerForm'=>'Новая группа привелегий',
            'routePost' =>'permGoup.save',
            'dataset'=>$permGrNew,
            'fields'=>[
                ['fieldName'=>'id', 'label'=>'id', 'type'=>'hidden', 'placeholder'=>''],
                ['fieldName'=>'name', 'label'=>'Наименование группы', 'type'=>'text', 'placeholder'=>'ФИО',],
                ['fieldName'=>'comment', 'label'=>'Описание', 'type'=>'text', 'placeholder'=>'Описание',],
                ['fieldName'=>'permission_arr', 'label'=>'Доступные привелегии', 'type'=>'checkbox','selections'=>$permissions,],
              //  ['fieldName'=>'deleted_at', 'label'=>'Группа удалена', 'type'=>'delete_at', 'flag'=>$recordDeleted,],
            ],
        ];


        return view('adm/adminPermissionGroupEdit',$params);
    }

    public function permissionGroupDelete(Request $request)
    {

        if(Gate::denies('open.home')){
            return redirect('/adm/adminDashboard');
        }
        if (isset($request->permissionId)){
            $permGroupDel = PermissionGroup::find($request->permGroupId);
            $permGroupDel->delete();
        }

        $permissionGroups = PermissionGroup::all();
        $params = [
            'header'=> 'Группы привелегий',
            'permissionGroups'=>$permissionGroups,
        ];
        return view('adm/adminPermissionGroups',$params);
    }

    /**
     * @param Request $request
     */
    public function permissionGroupSave(Request $request)
    {
//        $parameters= $request->all();
        $insertMode = is_null($request->id);
        $this->validate($request, [
            'name' => $insertMode ? 'required|unique:permission_groups|max:255': 'required|max:255',
            'comment' => 'required|max:255',
            'idCB' => 'required|array',
        ],
            [
                'required'=>'Поле ":attribute" должно быть заполнено',
                'unique'=>'Поле :attribute должно быть уникальным',
                'max:255'=>'Поле :attribute должно быть заполнено',
            ],
            [
                'name' => 'ФИО',
                'comment' => 'Описание',
                'idCB' => 'Доступные привелегии',
            ]
        );

        if ($insertMode ){
            $permissionGroup = new PermissionGroup;
        }else{
            $permissionGroup = PermissionGroup::find($request->id);
        }
        $permissionGroup->name = $request->name;
        $permissionGroup->comment = $request->comment;
        $checkBoxStd = implode(',',$request->idCB);
        $permissionGroup->permission_arr = $checkBoxStd;
        $permissionGroup->save();

        return redirect()->route('admin.permissionGroups');
    }

    public function blogs()
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }

        $blogList = BlogRepository::loadBlogs();
        $params = [
            'header'=>'Блог',
            'blogList' => $blogList
        ];
        return view('adm/adminBlogs');
    }

    public function bloglst()
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }

        $blogList = BlogRepository::loadBlogs();
        $params = [
            'header'=>'Блог',
            'blogList' => $blogList
        ];
        return $blogList;
    }

    public function blog(Request $request)
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $id = $request->id;
        $blog = BlogRepository::getBlogById($id);
        return $blog;
    }

    public function saveBlog(Request $request)
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $params = $request->all();
        if (isset($params['file_content'])) {
            $fileContent = ImageHelper::imageChangeAndSave($params['file_content'], 1024, 768, 200, 120, 'img', 1);
            $params['blog_img'] = $fileContent;
        }
        unset($params['file_content']);
        $res = BlogRepository::saveBlog($params);
        return $res;
    }

    public function deleteBlog(Request $request)
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $id = $request->id;
        $res = BlogRepository::deleteBlog($id);
        return $res;
    }


    public function loadBlogWithChat($blogid)
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $res = BlogRepository::getloadChatBlogById($blogid);
        return $res;
    }

    public function loadChat($blogid)
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $res = BlogRepository::loadChat($blogid);
        return $res;
    }

    public function saveBlogChat(Request $request)
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $params = $request->all();
        $res = BlogRepository::saveBlogChat($params);
        return $res;
    }

    public function deleteBlogChat(Request $request)
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $id = $request->id;
        $res = BlogRepository::deleteBlogChat($id);
        return $res;
    }



}