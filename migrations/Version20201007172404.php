<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007172404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D768BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_880E0D768BAC62AF ON admin (city_id)');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B02345C31A8C3');
        $this->addSql('DROP INDEX IDX_2D5B02345C31A8C3 ON city');
        $this->addSql('ALTER TABLE city DROP museums_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D768BAC62AF');
        $this->addSql('DROP INDEX IDX_880E0D768BAC62AF ON admin');
        $this->addSql('ALTER TABLE admin DROP city_id');
        $this->addSql('ALTER TABLE city ADD museums_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B02345C31A8C3 FOREIGN KEY (museums_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_2D5B02345C31A8C3 ON city (museums_id)');
    }
}
