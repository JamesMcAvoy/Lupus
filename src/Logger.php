<?php
namespace Lycanthrope;

use Symfony\Component\Console\Output\OutputInterface;

class Logger {

    /**
     * @var Symfony\Component\Console\Output\OutputInterface
     */
    private $output;

    public function __construct(OutputInterface $output) {

        $this->output = $output;

    }

    private function date() {

        return date('d/m H:i:s : ');

    }

    public function start() {

        $string = 'server running at <fg=green;options=underscore>ws://'.LYC_ADDR_LISTEN.':'.LYC_PORT_LISTEN.'</>';
        $this->output->writeln($this->date().$string);

    }

}
