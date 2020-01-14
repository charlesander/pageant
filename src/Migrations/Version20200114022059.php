<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20200114022059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate users table from original seed table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('insert into users (name) 
        (select created_by from _organisation)
        union
        (select updated_by from _organisation)
        union
        (select created_by from _organisation_contact)
        union
        (select updated_by from _organisation_contact)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE users');
    }
}
