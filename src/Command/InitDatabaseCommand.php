<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\ArrayInput;

class InitDatabaseCommand extends Command
{
    protected static $defaultName = 'init-database';

    protected function configure()
    {
        $this
            ->setDescription('The command initializes and populates the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //Init the database
        $returnCode = $this->runCommand($output, 'doctrine:database:create', []);
        if ($returnCode) {
            return $returnCode;
        }

        //import contries table
        $returnCode = $this->runCommand($output, 'doctrine:database:import', [
            'command' => 'doctrine:database:import',
            'file' => 'src/Seeds/countries.sql'
        ]);
        if ($returnCode) {
            return $returnCode;
        }

        //import organisation and organisation_contact tables
        $returnCode = $this->runCommand($output, 'doctrine:database:import', [
            'command' => 'doctrine:database:import',
            'file' => 'src/Seeds/test_manager_contact_edited.sql'
        ]);
        if ($returnCode) {
            return $returnCode;
        }

        return $returnCode;
    }

    private function runCommand(OutputInterface $output, string $commandName, array $arguments)
    {
        $command = $this->getApplication()->find($commandName);

        $greetInput = new ArrayInput($arguments);
        return $command->run($greetInput, $output);
    }
}
