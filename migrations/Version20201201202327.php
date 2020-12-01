<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201202327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE museum_review (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, museum_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, date DATE NOT NULL, rating DOUBLE PRECISION NOT NULL, INDEX IDX_468A7B4BA76ED395 (user_id), INDEX IDX_468A7B4B4B52E5B5 (museum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE museum_review ADD CONSTRAINT FK_468A7B4BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE museum_review ADD CONSTRAINT FK_468A7B4B4B52E5B5 FOREIGN KEY (museum_id) REFERENCES museum (id)');
        $this->addSql('DROP TABLE museum_reviews');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE museum_reviews (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, museum_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date DATE NOT NULL, rating DOUBLE PRECISION NOT NULL, INDEX IDX_FA46DD68A76ED395 (user_id), INDEX IDX_FA46DD684B52E5B5 (museum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE museum_reviews ADD CONSTRAINT FK_FA46DD684B52E5B5 FOREIGN KEY (museum_id) REFERENCES museum (id)');
        $this->addSql('ALTER TABLE museum_reviews ADD CONSTRAINT FK_FA46DD68A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE museum_review');
    }
}
