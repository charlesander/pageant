<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114023638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate contact table from original seed table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('insert into contact 
        (`name`)
        select distinct `name` from _organisation_contact;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('truncate contact');
    }
}
