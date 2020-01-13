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

        // Data cleaning:
        // Change the country_id in organisation to match the corresponding country record
        // in the countries table
        // 61 -> 232 = United States
        // 127 -> 38 = Canada
        // 158 -> 14 = Austria
        // 173 -> 13 = Australia
        $returnCode = $this->runCommand($output, 'doctrine:query:sql', [
            'command' => 'doctrine:query:sql',
            'sql' => 'update organisation set country_id = 232 where country_id = 61;
            update organisation set country_id = 38 where country_id = 127;
            update organisation set country_id = 14 where country_id = 158;
            update organisation set country_id = 13 where country_id = 173;'
        ]);
        if ($returnCode) {
            return $returnCode;
        }

        //Rename the tables in case they clash with the entity generated schemas
        $returnCode = $this->runCommand($output, 'doctrine:query:sql', [
            'command' => 'doctrine:query:sql',
            'sql' => 'RENAME TABLE organisation_contact TO _organisation_contact;
            RENAME TABLE organisation TO _organisation;
            RENAME TABLE countries TO _countries;'
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
