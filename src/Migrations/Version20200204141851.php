<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200204141851 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, art_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comic_strip (id INT AUTO_INCREMENT NOT NULL, comic_name VARCHAR(255) DEFAULT NULL, comic_description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comic_strip_artist (comic_strip_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_D335448518D44FD2 (comic_strip_id), INDEX IDX_D3354485B7970CF8 (artist_id), PRIMARY KEY(comic_strip_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, ser_name VARCHAR(255) NOT NULL, ser_editor VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comic_strip_artist ADD CONSTRAINT FK_D335448518D44FD2 FOREIGN KEY (comic_strip_id) REFERENCES comic_strip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comic_strip_artist ADD CONSTRAINT FK_D3354485B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comic_strip_artist DROP FOREIGN KEY FK_D3354485B7970CF8');
        $this->addSql('ALTER TABLE comic_strip_artist DROP FOREIGN KEY FK_D335448518D44FD2');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE comic_strip');
        $this->addSql('DROP TABLE comic_strip_artist');
        $this->addSql('DROP TABLE serie');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
