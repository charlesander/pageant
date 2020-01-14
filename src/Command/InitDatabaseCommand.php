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

        //Import countries table
        $returnCode = $this->runCommand($output, 'doctrine:database:import', [
            'command' => 'doctrine:database:import',
            'file' => 'src/Seeds/countries.sql'
        ]);

        if ($returnCode) {
            return $returnCode;
        }

        //Import organisation and organisation_contact tables
        $returnCode = $this->runCommand($output, 'doctrine:database:import', [
            'command' => 'doctrine:database:import',
            'file' => 'src/Seeds/test_manager_contact_edited.sql'
        ]);

        if ($returnCode) {
            return $returnCode;
        }

        /**
         * 1) Data cleaning:
         * Change the country_id in organisation to match the corresponding country record
         * in the countries table
         * 61 -> 232 = United States
         * 127 -> 38 = Canada
         * 158 -> 14 = Austria
         * 173 -> 13 = Australia
         *
         * 2) Rename the tables in case they clash with the entity generated schemas
         * 3) Generate tables from entities
         * 4) Populate users table from original seed table
         * 5) Populate country table from original seed table
         * 6) Populate organisation table from original seed table
         * 7) Populate contact table from original seed table
         * 8) Populate organisation_role table from original seed table
         * 9) Remove original seed tables - they are not needed anymore
         */
        $returnCode = $this->runCommand($output, 'doctrine:migrations:migrate', [
            '20200114025827'
        ]);

        return $returnCode;
    }

    private function runCommand(OutputInterface $output, string $commandName, array $arguments)
    {
        $command = $this->getApplication()->find($commandName);

        $greetInput = new ArrayInput($arguments);
        return $command->run($greetInput, $output);
    }
}
