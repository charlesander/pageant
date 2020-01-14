<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20200114025827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove original seed tables - they are not needed anymore';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE _organisation_contact DROP FOREIGN KEY fk_organisation_id');
        $this->addSql('DROP TABLE _organisation_contact');
        $this->addSql('DROP TABLE _organisation');
        $this->addSql('DROP TABLE _countries');
    }

    public function down(Schema $schema): void
    {
        //Complicated...
    }
}
