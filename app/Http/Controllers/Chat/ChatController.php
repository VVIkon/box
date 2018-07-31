<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 15.05.18
 * Time: 11:40
 */

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Route;
use \Gate;
use \Auth;
use App\Notifications\Socket\Repository\ChatRepositiry;
use App\Notifications\Socket\Pusher;


class ChatController extends Controller
{
    public function index()
    {
        if(Gate::denies('open.home')){
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $subcribeUsers = ChatRepositiry::getChatSubscribers($userId);


        return view('chat.chat',['subcribeUsers'=>$subcribeUsers]);
    }

    /**
     * {"userid": 1, "subscriberid": 2}
     * @param Request $request
     * @return string
     */
    public function history(Request $request)
    {
        $userId = $request->userid;
        $subscriberId = $request->subscriberid;
        if (isset($userId)){
            $result = ChatRepositiry::getChatByUser($userId, $subscriberId);
        }
        return json_encode($result);
    }

    public function writeme(Request $request)
    {
        $toUserId = $request->touserid;
        $writerId = $request->writerid;

        $data = [
            'topic_id'=>'onNewData',
            'data'=>'Пишет...',
            'writerid'=> $writerId,
            'toUserId'=> $toUserId,
        ];
        Pusher::sendDataToServer($data);
        return json_encode(['status'=>true]);
    }

    public function users()
    {
        $responceArr = [
            0 => [
                    'role'=>'Student',
                    'id'=>'1',
                    'name'=>'Иванов Иван',
                    'phone'=>'916-168-00-00'
               ],
            1 => [
                    'role'=>'Support',
                    'id'=>'2',
                    'name'=>'Петров Пётр',
                    'phone'=>'916-168-10-10'
               ],
            2 => [
                    'role'=>'Administrator',
                    'id'=>'3',
                    'name'=>'Сидоров Содор',
                    'phone'=>'916-168-22-22'
               ],
            ];
        return json_encode($responceArr);
    }
}