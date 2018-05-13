<?php
namespace Lycanthrope\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Lycanthrope\Exception\ExceptionInterface;
use Lycanthrope\Config;
use Lycanthrope\Main as LycanthropeGame;

class RunServerCommand extends Command {

    protected function configure() {
        $this
            ->setName('run')
            ->setDescription('Run the server')
            ->setHelp('This command allows you to run the WebSocket server')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output) {

        try {
            Config::boot();

            require_once dirname(__DIR__) . '/../game/' . LYC_MAIN;

            $server = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new \App($output)
                    )
                ),
                LYC_PORT_LISTEN,
                LYC_ADDR_LISTEN
            );

            $server->run();
        } catch(ExceptionInterface $e) {
            $output->writeln([
                '',
                'Error : <error>'.$e->getMessage().'</error>',
                ''
            ]);
        }

    }

}
