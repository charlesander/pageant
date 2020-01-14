<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * List from https://github.com/raramuridesign/mysql-country-list/blob/master/mysql-country-list.sql
 * Class Version20200114022433
 * @package DoctrineMigrations
 */
final class Version20200114022433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate country table from original seed table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('insert into country
                        select * from _countries;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('truncate country');
    }
}
