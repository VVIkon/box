<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 03.06.18
 * Time: 11:26
 */

namespace App\Notifications\Socket;

use App\Notifications\Socket\BaseClasses\BasePusher;
use ZMQContext;
use ZMQSocketException;


class Pusher extends BasePusher
{
    public static function sendDataToServer(array $data)
    {
        $context = new ZMQContext();
        try {
            $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'Pusher VI');
            $socket->connect('tcp://127.0.0.1:5555');
            $dataJson = json_encode($data);
            $socket->send($dataJson);
        }catch (ZMQSocketException $se){
            echo "Pusher didn't get socket connection";
        }

    }

    public function broadcast($jsonDataToSend)
    {
        $dataToSend = json_decode($jsonDataToSend, true);
        $subscribedTopics = $this->getSubscribeTopics();
        if (isset($subscribedTopics[$dataToSend['topic_id'] ]) ){
            $topic = $subscribedTopics[$dataToSend['topic_id']];
            $topic->broadcast($dataToSend);
        }
    }
}