<?php

namespace App\Console\Commands\Users;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

class SaveUser extends Command
{
    protected $signature = 'user:save {user, request}';
    protected $description = 'Сохранение реквизитов пользователя';
    protected $user;
    protected $imgFile;

    public function __construct(User $user, Request $request)
    {
        parent::__construct();
        $this->user = $user;
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        if (isset($request->password) ){
            $this->user->password = bcrypt($request->password);
        }
        $this->user->permission_group_id = $request->permission_group_id;
        $this->imgFile = $request->file('imgPath');

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->user->imgPath = ImageHelper::imageChangeAndSave($this->imgFile);
        $this->user->save();
    }

}
