<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201006193415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, museum_id INT DEFAULT NULL, time TIME NOT NULL, day_of_the_week VARCHAR(255) NOT NULL, INDEX IDX_5A3811FB4B52E5B5 (museum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, tour_operator_id INT DEFAULT NULL, schedule_id INT DEFAULT NULL, time TIME NOT NULL, number INT NOT NULL, price NUMERIC(10, 0) NOT NULL, INDEX IDX_97A0ADA33813CA60 (tour_operator_id), INDEX IDX_97A0ADA3A40BC2D5 (schedule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB4B52E5B5 FOREIGN KEY (museum_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA33813CA60 FOREIGN KEY (tour_operator_id) REFERENCES tour_operator (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedule (id)');
        $this->addSql('ALTER TABLE admin ADD additional_information VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234AAFBCFB7');
        $this->addSql('DROP INDEX IDX_2D5B0234AAFBCFB7 ON city');
        $this->addSql('ALTER TABLE city DROP tour_operators_id');
        $this->addSql('ALTER TABLE tour_operator ADD city_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD f_name VARCHAR(255) NOT NULL, ADD phone_number VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tour_operator ADD CONSTRAINT FK_4D59FEB28BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_4D59FEB28BAC62AF ON tour_operator (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A40BC2D5');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('ALTER TABLE admin DROP additional_information');
        $this->addSql('ALTER TABLE city ADD tour_operators_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234AAFBCFB7 FOREIGN KEY (tour_operators_id) REFERENCES tour_operator (id)');
        $this->addSql('CREATE INDEX IDX_2D5B0234AAFBCFB7 ON city (tour_operators_id)');
        $this->addSql('ALTER TABLE tour_operator DROP FOREIGN KEY FK_4D59FEB28BAC62AF');
        $this->addSql('DROP INDEX IDX_4D59FEB28BAC62AF ON tour_operator');
        $this->addSql('ALTER TABLE tour_operator DROP city_id, DROP name, DROP f_name, DROP phone_number');
    }
}
