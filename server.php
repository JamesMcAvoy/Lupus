<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Lycanthrope\Game as LycanthropeGame;

require __DIR__ .'/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new LycanthropeGame()
            )
        ),
    8080
);

$server->run();
// La nuit tombe...
