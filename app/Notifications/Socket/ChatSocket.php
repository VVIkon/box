<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 15.05.18
 * Time: 10:31
 */

namespace App\Notifications\Socket;
use App\Notifications\Socket\BaseClasses\BaseSocket;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use App\Notifications\Socket\Repository\ChatRepositiry;
use \Auth;

class ChatSocket extends BaseSocket
{
    protected $clients;

    /**
     * ChatSocket constructor.
     * @param array $clients
     */
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }


    /**
     * @param ConnectionInterface $conn
     */
    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Установлено новое соединение: {$conn->resourceId}\n";
    }

    /**
     * @param ConnectionInterface $conn
     */
    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Соединение {$conn->resourceId} разорвано\n";
    }
    /**
     * @param ConnectionInterface $conn
     * @param MessageInterface $msg
     */
    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {

        $saveChat = ChatRepositiry::setChat($msg);
        $cntConn = count($this->clients)-1;
        echo "Соединение {$conn->resourceId} передало сообщение {$msg} другим {$cntConn} соединениям \n";
        foreach ($this->clients as $client){
                $client->send($msg);
        }
    }

}