<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201003134056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, museums_id INT DEFAULT NULL, tour_operators_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image LONGBLOB NOT NULL, INDEX IDX_2D5B0234F92F3E70 (country_id), INDEX IDX_2D5B02345C31A8C3 (museums_id), INDEX IDX_2D5B0234AAFBCFB7 (tour_operators_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B02345C31A8C3 FOREIGN KEY (museums_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234AAFBCFB7 FOREIGN KEY (tour_operators_id) REFERENCES tour_operator (id)');
        $this->addSql('ALTER TABLE admin ADD user_id INT DEFAULT NULL, ADD museum_name VARCHAR(255) NOT NULL, ADD image LONGBLOB NOT NULL, ADD max_capacity INT NOT NULL, DROP email, DROP password');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76A76ED395 ON admin (user_id)');
        $this->addSql('ALTER TABLE tour_operator ADD user_id INT DEFAULT NULL, DROP email, DROP password');
        $this->addSql('ALTER TABLE tour_operator ADD CONSTRAINT FK_4D59FEB2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4D59FEB2A76ED395 ON tour_operator (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234F92F3E70');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76A76ED395');
        $this->addSql('DROP INDEX UNIQ_880E0D76A76ED395 ON admin');
        $this->addSql('ALTER TABLE admin ADD password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP user_id, DROP image, DROP max_capacity, CHANGE museum_name email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE tour_operator DROP FOREIGN KEY FK_4D59FEB2A76ED395');
        $this->addSql('DROP INDEX UNIQ_4D59FEB2A76ED395 ON tour_operator');
        $this->addSql('ALTER TABLE tour_operator ADD email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP user_id');
    }
}
