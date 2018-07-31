<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 01.06.18
 * Time: 13:30
 */

namespace App\Notifications\Socket\BaseClasses;

use Ratchet\Wamp\Topic;
use Ratchet\Wamp\WampServerInterface;
use Ratchet\ConnectionInterface;


class BasePusher implements WampServerInterface
{

    protected $subscribeTopics = [];


    public function getSubscribeTopics()
    {
        return $this->subscribeTopics;
    }

    public function addSubscribeTopic($topic)
    {
        $this->subscribeTopics[$topic->getId()]=$topic;
    }

    /**
     * @param ConnectionInterface $conn
     * @param Topic|string $topic
     * @return mixed
     */
    function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->addSubscribeTopic($topic);
    }

    /**
     * @param ConnectionInterface $conn
     * @param Topic|string $topic
     * @return mixed
     */
    function onUnSubscribe(ConnectionInterface $conn, $topic)
    {
        // TODO: Implement onUnSubscribe() method.
    }

    /**
     * @param ConnectionInterface $conn
     * @param string $id
     * @param Topic|string $topic
     * @param array $params
     * @return mixed
     */
    function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }

    /**
     * @param ConnectionInterface $conn
     * @param Topic|string $topic
     * @param string $event
     * @param array $exclude
     * @param array $eligible
     * @return mixed
     */
    function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        $conn->close();
    }

    /**
     * @param ConnectionInterface $conn
     * @return mixed
     */
    function onOpen(ConnectionInterface $conn)
    {
        echo "New connection: ({$conn->resourceId})\n";
    }

    /**
     * @param ConnectionInterface $conn
     * @return mixed
     */
    function onClose(ConnectionInterface $conn)
    {
        echo "Connection ({$conn->resourceId}) has bean disconnected";
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     * @return mixed
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occured: {$e->getMessage()}\n";
    }
}