<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 16.05.18
 * Time: 13:18
 */
namespace App\Notifications\Socket\Repository;

use App\Models\InterChat;
use App\Models\SubscribeChat;

class ChatRepositiry
{
    /**
     * @param $message
     * @param null $chatId
     * @return bool
     */
    public static function setChat($message)
    {
        if (is_null($message)){
            return false;
        }
        //  {"name":"vvikon","id":"1", "subscribers":[2,3], "msg":"111"}
        $msg = json_decode($message,True);
        $subscribers = json_decode($msg['subscribers']);
        if (isset($subscribers)) {
            foreach ($subscribers as $subscriberId){
                $chat = new InterChat;
                $chat->user_id = $msg['id'];
                $chat->for_user_id = $subscriberId;
                $chat->user_message = $msg['msg'];
                $chat->save();
            }
            return true;
        }
        return false;
    }

    public static function getChatSubscribers($userId)
    {
        $subscribers = SubscribeChat::with('user')->where('user_id','=',$userId)->get();
//        where('user_id','=',$userId)->user();
//        $subscribersU = $subscribers->toArray();
        return $subscribers;
    }

    public static function getChatByUser($userId, $subscriberId)
    {
        $userChats = InterChat::with( 'user', 'forUser')
            ->where(function($query) use($userId, $subscriberId) {
                $query->where('user_id', $userId)->where('for_user_id',  $subscriberId);
            })
            ->orWhere(function($query) use($userId, $subscriberId) {
                $query->where('user_id', $subscriberId)->where('for_user_id',  $userId);
            })
            ->select('user_id', 'for_user_id', 'user_message', 'created_at')
            //->toSql();
            ->get()
            ->toArray();


        foreach ($userChats as $userChat){
            $chatArr[]=[
                'id'=>$userChat['user_id'],
                'user_id'=>$userChat['user_id'],
                'user_name'=> $userChat['user']['name'],
                'name'=> $userChat['user']['name'],
                'for_user_id'=> $userChat['for_user_id'],
                'for_user_name'=>$userChat['for_user']['name'],
                'msg'=> $userChat['user_message'],
                'created_at'=> $userChat['created_at']
            ];
        }
        return $chatArr;
    }

}