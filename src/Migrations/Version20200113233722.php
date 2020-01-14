<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20200113233722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'organisation.country_id data cleanup';
    }

    /**
     * Data cleaning:
     * Change the country_id in organisation to match the corresponding country record
     * in the countries table
     * 61 -> 232 = United States
     * 127 -> 38 = Canada
     * 158 -> 14 = Austria
     * 173 -> 13 = Australia
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('update organisation set country_id = 232 where country_id = 61;');
        $this->addSql('update organisation set country_id = 38 where country_id = 127;');
        $this->addSql('update organisation set country_id = 14 where country_id = 158;');
        $this->addSql('update organisation set country_id = 13 where country_id = 173;');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('update organisation set country_id = 61 where country_id = 232;');
        $this->addSql('update organisation set country_id = 127 where country_id = 38;');
        $this->addSql('update organisation set country_id = 158 where country_id = 14;');
        $this->addSql('update organisation set country_id = 173 where country_id = 13;');
    }
}
