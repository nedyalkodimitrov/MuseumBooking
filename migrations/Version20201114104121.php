<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114104121 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4B52E5B5');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB4B52E5B5');
        $this->addSql('CREATE TABLE museum (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, city_id INT DEFAULT NULL, museum_name VARCHAR(255) NOT NULL, additional_information VARCHAR(255) NOT NULL, image LONGBLOB NOT NULL, max_capacity INT NOT NULL, UNIQUE INDEX UNIQ_62474477A76ED395 (user_id), INDEX IDX_624744778BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE museum ADD CONSTRAINT FK_62474477A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE museum ADD CONSTRAINT FK_624744778BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('DROP TABLE admin');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4B52E5B5');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4B52E5B5 FOREIGN KEY (museum_id) REFERENCES museum (id)');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB4B52E5B5');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB4B52E5B5 FOREIGN KEY (museum_id) REFERENCES museum (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4B52E5B5');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB4B52E5B5');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, city_id INT DEFAULT NULL, museum_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, image LONGBLOB NOT NULL, max_capacity INT NOT NULL, additional_information VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_880E0D768BAC62AF (city_id), UNIQUE INDEX UNIQ_880E0D76A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D768BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE museum');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4B52E5B5');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4B52E5B5 FOREIGN KEY (museum_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB4B52E5B5');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB4B52E5B5 FOREIGN KEY (museum_id) REFERENCES admin (id)');
    }
}
