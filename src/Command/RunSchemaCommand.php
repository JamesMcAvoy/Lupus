<?php
namespace Lycanthrope\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Lycanthrope\Config;
use Lycanthrope\Exception\ExceptionInterface;

class RunSchemaCommand extends Command {

    protected function configure() {
        $this
            ->setName('db:schema')
            ->setDescription('Run a schema')
            ->setHelp('This command allows you to create tables with the schema from your configuration file.'."\n".'It resets the database.')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output) {

        $output->getFormatter()->setStyle('danger', new OutputFormatterStyle('red'));
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('<danger>Attention : this command resets the database, are you sure ? (y/n)</danger>:', false);

        if(!$helper->ask($input, $output, $question)) {
            return;
        }

        try {
            Config::schema($output);
        } catch(ExceptionInterface $e) {
            $output->writeln([
                '',
                'Error : <error>'.$e->getMessage().'</error>',
                ''
            ]);
        }

    }

}
