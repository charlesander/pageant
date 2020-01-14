<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20200114025505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate organisation_role table from original seed table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('insert into organisation_role
        (organisation_id, contact_id, created_by_id, updated_by_id, title, phone, email, active, created_on, updated_on, deleted) 
        select organisation_id, 
        (select id from contact where contact.`name` = _organisation_contact.name limit 1), 
        (select id from users where users.`name` = _organisation_contact.created_by limit 1), 
        (select id from users where users.`name` = _organisation_contact.updated_by limit 1), 
        title, phone, email, 
        active, created_on, updated_on,
        deleted
        from _organisation_contact;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('truncate organisation_role');
    }
}
