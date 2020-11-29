<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127201251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE museum_reviews (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, museum_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_FA46DD68A76ED395 (user_id), INDEX IDX_FA46DD684B52E5B5 (museum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE museum_reviews ADD CONSTRAINT FK_FA46DD68A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE museum_reviews ADD CONSTRAINT FK_FA46DD684B52E5B5 FOREIGN KEY (museum_id) REFERENCES museum (id)');
        $this->addSql('ALTER TABLE ticket ADD is_come TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE museum_reviews');
        $this->addSql('ALTER TABLE ticket DROP is_come');
    }
}
