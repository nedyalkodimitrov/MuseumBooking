<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201203759 extends AbstractMigration
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
        $this->addSql('ALTER TABLE museum_review ADD CONSTRAINT FK_468A7B4BA76ED395 FOREIGN KEY (user_id) REFERENCES tour_operator (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE museum_review DROP FOREIGN KEY FK_468A7B4BA76ED395');
        $this->addSql('ALTER TABLE museum_review ADD CONSTRAINT FK_468A7B4BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
