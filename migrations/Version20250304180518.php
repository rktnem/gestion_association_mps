<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304180518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association ADD deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE membre membre INT DEFAULT NULL, CHANGE nom_president nom_president VARCHAR(255) NOT NULL, CHANGE numero_recepisse numero_recepisse VARCHAR(150) NOT NULL');
        $this->addSql('ALTER TABLE association_besoin DROP FOREIGN KEY FK_B26CDD66EFB9C8A5');
        $this->addSql('ALTER TABLE association_besoin ADD CONSTRAINT FK_B26CDD66EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association DROP deleted_at, CHANGE membre membre INT NOT NULL, CHANGE nom_president nom_president VARCHAR(255) DEFAULT NULL, CHANGE numero_recepisse numero_recepisse VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE association_besoin DROP FOREIGN KEY FK_B26CDD66EFB9C8A5');
        $this->addSql('ALTER TABLE association_besoin ADD CONSTRAINT FK_B26CDD66EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
