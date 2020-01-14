<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200113233729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Rename the tables in case they clash with the entity generated schemas';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('RENAME TABLE organisation_contact TO _organisation_contact;');
        $this->addSql('RENAME TABLE organisation TO _organisation;');
        $this->addSql('RENAME TABLE countries TO _countries;');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('RENAME TABLE _organisation_contact TO organisation_contact;');
        $this->addSql('RENAME TABLE _organisation TO organisation;');
        $this->addSql('RENAME TABLE _countries TO countries;');
    }
}
