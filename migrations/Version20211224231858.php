<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211224231858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, travail_id INT DEFAULT NULL, etudiant_id INT DEFAULT NULL, lien_de_travail VARCHAR(255) DEFAULT NULL, note INT DEFAULT NULL, INDEX IDX_47948BBCEEFE7EA9 (travail_id), INDEX IDX_47948BBCDDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCEEFE7EA9 FOREIGN KEY (travail_id) REFERENCES travail (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE depot');
    }
}
