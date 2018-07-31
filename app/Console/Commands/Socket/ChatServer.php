<?php

namespace App\Console\Commands\Socket;

use App\Notifications\Socket\ChatSocket;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class ChatServer extends Command
{

    protected $signature = 'chatServer:run';
    protected $description = 'Запуск чат-сервера';


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
        $this->info('Chat server running (Ctrl+C to stop)');
        $chatServer = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ChatSocket()
                )
            ),8888
        );
        $chatServer->run();
    }
}
