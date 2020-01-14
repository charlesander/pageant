<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20200114001113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generate schema from entities';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, country_code VARCHAR(2) NOT NULL, country_name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisation (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, address1 VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, address3 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, web VARCHAR(255) DEFAULT NULL, created_on DATETIME NOT NULL, updated_on DATETIME DEFAULT NULL, deleted TINYINT(1) NOT NULL, INDEX IDX_E6E132B4F92F3E70 (country_id), INDEX IDX_E6E132B4B03A8386 (created_by_id), INDEX IDX_E6E132B4896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisation_role (id INT AUTO_INCREMENT NOT NULL, organisation_id INT NOT NULL, contact_id INT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, title VARCHAR(100) DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, active TINYINT(1) NOT NULL, created_on DATETIME NOT NULL, updated_on DATETIME DEFAULT NULL, deleted TINYINT(1) NOT NULL, INDEX IDX_152D8A729E6B1585 (organisation_id), INDEX IDX_152D8A72E7A1254A (contact_id), INDEX IDX_152D8A72B03A8386 (created_by_id), INDEX IDX_152D8A72896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE organisation ADD CONSTRAINT FK_E6E132B4F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE organisation ADD CONSTRAINT FK_E6E132B4B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE organisation ADD CONSTRAINT FK_E6E132B4896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE organisation_role ADD CONSTRAINT FK_152D8A729E6B1585 FOREIGN KEY (organisation_id) REFERENCES organisation (id)');
        $this->addSql('ALTER TABLE organisation_role ADD CONSTRAINT FK_152D8A72E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE organisation_role ADD CONSTRAINT FK_152D8A72B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE organisation_role ADD CONSTRAINT FK_152D8A72896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE organisation DROP FOREIGN KEY FK_E6E132B4F92F3E70');
        $this->addSql('ALTER TABLE organisation_role DROP FOREIGN KEY FK_152D8A729E6B1585');
        $this->addSql('ALTER TABLE organisation_role DROP FOREIGN KEY FK_152D8A72E7A1254A');
        $this->addSql('ALTER TABLE organisation DROP FOREIGN KEY FK_E6E132B4B03A8386');
        $this->addSql('ALTER TABLE organisation DROP FOREIGN KEY FK_E6E132B4896DBBDE');
        $this->addSql('ALTER TABLE organisation_role DROP FOREIGN KEY FK_152D8A72B03A8386');
        $this->addSql('ALTER TABLE organisation_role DROP FOREIGN KEY FK_152D8A72896DBBDE');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE organisation_role');
    }
}
