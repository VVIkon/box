<?php

namespace App\Console\Commands\Socket;

use Illuminate\Console\Command;
//use Symfony\Component\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

use App\Notifications\Socket\Pusher;
use React\EventLoop\Factory as ReactLoop;
use React\ZMQ\Context as ReactContext;
use React\Socket\Server as ReactServer;
use Ratchet\Wamp\WampServer;

use App\Notifications\Socket\ChatSocket;

class PushServer extends Command
{
    protected $signature = 'pushServer:run';
    protected $description = 'Запуск Push-сервера';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        echo '1';
        $loop = ReactLoop::create();
        $pusher = new Pusher();

        $context = new ReactContext($loop);
        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        $pull->bind('tcp://127.0.0.1:5555');
        $pull->on('message', [$pusher, 'broadcast']);

        $webSocket = new ReactServer(8080, $loop );
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new WampServer($pusher)
                )
            ),$webSocket
        );
        $this->info('Push server running (Ctrl+C to stop)');
        $loop->run();
    }
}
