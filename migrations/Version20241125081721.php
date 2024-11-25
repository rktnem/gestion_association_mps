<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241125081721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE association_besoin (association_id INT NOT NULL, besoin_id INT NOT NULL, INDEX IDX_B26CDD66EFB9C8A5 (association_id), INDEX IDX_B26CDD66FE6EED44 (besoin_id), PRIMARY KEY(association_id, besoin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE besoin (id INT AUTO_INCREMENT NOT NULL, nom_besoin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE association_besoin ADD CONSTRAINT FK_B26CDD66EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association_besoin ADD CONSTRAINT FK_B26CDD66FE6EED44 FOREIGN KEY (besoin_id) REFERENCES besoin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association CHANGE commune_id commune_id INT NOT NULL, CHANGE membre membre INT DEFAULT NULL, CHANGE besoin_default besoin_default LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE association RENAME INDEX type_association_id TO IDX_FD8521CCB97AE131');
        $this->addSql('ALTER TABLE commune CHANGE nom nom VARCHAR(150) NOT NULL');
        $this->addSql('ALTER TABLE type_association DROP createdAt, DROP updatedAt, CHANGE type type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association_besoin DROP FOREIGN KEY FK_B26CDD66EFB9C8A5');
        $this->addSql('ALTER TABLE association_besoin DROP FOREIGN KEY FK_B26CDD66FE6EED44');
        $this->addSql('DROP TABLE association_besoin');
        $this->addSql('DROP TABLE besoin');
        $this->addSql('ALTER TABLE association CHANGE commune_id commune_id INT DEFAULT NULL, CHANGE membre membre INT NOT NULL, CHANGE besoin_default besoin_default VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE association RENAME INDEX idx_fd8521ccb97ae131 TO type_association_id');
        $this->addSql('ALTER TABLE type_association ADD createdAt DATETIME NOT NULL, ADD updatedAt DATETIME NOT NULL, CHANGE type type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commune CHANGE nom nom VARCHAR(255) NOT NULL');
    }
}
