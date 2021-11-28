<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106171249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE landmark (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, rating DOUBLE PRECISION NOT NULL, landmark_name VARCHAR(255) NOT NULL, additional_information VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, latitude VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, INDEX IDX_D6DBBF068BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip (id INT AUTO_INCREMENT NOT NULL, leader_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image LONGBLOB NOT NULL, start_date VARCHAR(255) NOT NULL, end_date VARCHAR(255) NOT NULL, INDEX IDX_7656F53B73154ED4 (leader_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trips_museums (trip_id INT NOT NULL, museum_id INT NOT NULL, INDEX IDX_6DD1CF0AA5BC2E0E (trip_id), INDEX IDX_6DD1CF0A4B52E5B5 (museum_id), PRIMARY KEY(trip_id, museum_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trips_tourOperators (trip_id INT NOT NULL, tourOperator_id INT NOT NULL, INDEX IDX_9445376CA5BC2E0E (trip_id), INDEX IDX_9445376C5B4EF193 (tourOperator_id), PRIMARY KEY(trip_id, tourOperator_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trips_landmarks (landmark_id INT NOT NULL, PRIMARY KEY(landmark_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wish_list (id INT AUTO_INCREMENT NOT NULL, tour_operator_id INT DEFAULT NULL, museum_id INT DEFAULT NULL, landmark_id INT DEFAULT NULL, added_date VARCHAR(255) NOT NULL, INDEX IDX_5B8739BD3813CA60 (tour_operator_id), INDEX IDX_5B8739BD4B52E5B5 (museum_id), INDEX IDX_5B8739BD1090007F (landmark_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE landmark ADD CONSTRAINT FK_D6DBBF068BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B73154ED4 FOREIGN KEY (leader_id) REFERENCES tour_operator (id)');
        $this->addSql('ALTER TABLE trips_museums ADD CONSTRAINT FK_6DD1CF0AA5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)');
        $this->addSql('ALTER TABLE trips_museums ADD CONSTRAINT FK_6DD1CF0A4B52E5B5 FOREIGN KEY (museum_id) REFERENCES museum (id)');
        $this->addSql('ALTER TABLE trips_tourOperators ADD CONSTRAINT FK_9445376CA5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)');
        $this->addSql('ALTER TABLE trips_tourOperators ADD CONSTRAINT FK_9445376C5B4EF193 FOREIGN KEY (tourOperator_id) REFERENCES tour_operator (id)');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BD3813CA60 FOREIGN KEY (tour_operator_id) REFERENCES tour_operator (id)');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BD4B52E5B5 FOREIGN KEY (museum_id) REFERENCES museum (id)');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BD1090007F FOREIGN KEY (landmark_id) REFERENCES landmark (id)');
        $this->addSql('ALTER TABLE city CHANGE country_id country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE museum_id museum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE museum CHANGE user_id user_id INT DEFAULT NULL, CHANGE city_id city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE museum_review CHANGE tour_operator_id tour_operator_id INT DEFAULT NULL, CHANGE museum_id museum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE museum_worker CHANGE museum_id museum_id INT DEFAULT NULL, CHANGE city_id city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE day_id day_id INT DEFAULT NULL, CHANGE museum_id museum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket CHANGE tour_operator_id tour_operator_id INT DEFAULT NULL, CHANGE schedule_id schedule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tour_operator CHANGE user_id user_id INT DEFAULT NULL, CHANGE city_id city_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wish_list DROP FOREIGN KEY FK_5B8739BD1090007F');
        $this->addSql('ALTER TABLE trips_museums DROP FOREIGN KEY FK_6DD1CF0AA5BC2E0E');
        $this->addSql('ALTER TABLE trips_tourOperators DROP FOREIGN KEY FK_9445376CA5BC2E0E');
        $this->addSql('DROP TABLE landmark');
        $this->addSql('DROP TABLE trip');
        $this->addSql('DROP TABLE trips_museums');
        $this->addSql('DROP TABLE trips_tourOperators');
        $this->addSql('DROP TABLE trips_landmarks');
        $this->addSql('DROP TABLE wish_list');
        $this->addSql('ALTER TABLE city CHANGE country_id country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE museum_id museum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE museum CHANGE user_id user_id INT DEFAULT NULL, CHANGE city_id city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE museum_review CHANGE tour_operator_id tour_operator_id INT DEFAULT NULL, CHANGE museum_id museum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE museum_worker CHANGE museum_id museum_id INT DEFAULT NULL, CHANGE city_id city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE day_id day_id INT DEFAULT NULL, CHANGE museum_id museum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket CHANGE tour_operator_id tour_operator_id INT DEFAULT NULL, CHANGE schedule_id schedule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tour_operator CHANGE user_id user_id INT DEFAULT NULL, CHANGE city_id city_id INT DEFAULT NULL');
    }
}
