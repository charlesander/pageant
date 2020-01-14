<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20200114023420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate organisation table from original seed table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('insert into organisation
        (`name`, address1, address2, 
        address3, city, country_id, 
        postal_code, email, phone, 
        web, created_on, created_by_id,
        updated_on, updated_by_id, deleted)
        select `name`, address1, address2, 
        address3, city, country_id, 
        postal_code, email, phone, 
        web, created_on, (select id from users where users.`name` = _organisation.created_by limit 1),
        updated_on, (select id from users where users.`name` = _organisation.updated_by limit 1), deleted from _organisation;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('truncate organisation');
    }
}
