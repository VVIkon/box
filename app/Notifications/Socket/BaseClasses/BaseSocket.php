<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 15.05.18
 * Time: 10:11
 */

namespace App\Notifications\Socket\BaseClasses;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use Ratchet\ConnectionInterface;


class BaseSocket implements MessageComponentInterface
{
    /**
     * @param ConnectionInterface $conn
     * @return mixed
     */
    function onOpen(ConnectionInterface $conn)
    {
        // TODO: Implement onOpen() method.
    }

    /**
     * @param ConnectionInterface $conn
     * @return mixed
     */
    function onClose(ConnectionInterface $conn)
    {
        // TODO: Implement onClose() method.
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     * @return mixed
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo 'Возникла ошибка сокета: '+ $e->getMessage()+'\n';
        $conn->close();
    }

    /**
     * @param ConnectionInterface $conn
     * @param MessageInterface $msg
     * @return mixed
     */
    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        // TODO: Implement onMessage() method.
    }


}