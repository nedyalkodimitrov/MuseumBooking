<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201203942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE museum_review DROP FOREIGN KEY FK_468A7B4BA76ED395');
        $this->addSql('DROP INDEX IDX_468A7B4BA76ED395 ON museum_review');
        $this->addSql('ALTER TABLE museum_review CHANGE user_id tour_operator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE museum_review ADD CONSTRAINT FK_468A7B4B3813CA60 FOREIGN KEY (tour_operator_id) REFERENCES tour_operator (id)');
        $this->addSql('CREATE INDEX IDX_468A7B4B3813CA60 ON museum_review (tour_operator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE museum_review DROP FOREIGN KEY FK_468A7B4B3813CA60');
        $this->addSql('DROP INDEX IDX_468A7B4B3813CA60 ON museum_review');
        $this->addSql('ALTER TABLE museum_review CHANGE tour_operator_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE museum_review ADD CONSTRAINT FK_468A7B4BA76ED395 FOREIGN KEY (user_id) REFERENCES tour_operator (id)');
        $this->addSql('CREATE INDEX IDX_468A7B4BA76ED395 ON museum_review (user_id)');
    }
}
