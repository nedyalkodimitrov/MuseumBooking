<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123191558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE museum_worker (id INT AUTO_INCREMENT NOT NULL, museum_id INT DEFAULT NULL, city_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, f_name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, INDEX IDX_A07B45EF4B52E5B5 (museum_id), INDEX IDX_A07B45EF8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE museum_worker ADD CONSTRAINT FK_A07B45EF4B52E5B5 FOREIGN KEY (museum_id) REFERENCES museum (id)');
        $this->addSql('ALTER TABLE museum_worker ADD CONSTRAINT FK_A07B45EF8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE museum_worker');
    }
}
