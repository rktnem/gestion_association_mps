<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404165109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE direction (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, prenom VARCHAR(250) NOT NULL, cin INT NOT NULL, email VARCHAR(150) NOT NULL, contact VARCHAR(15) NOT NULL, imatriculation INT NOT NULL, photo VARCHAR(255) DEFAULT NULL, date_delivrance_cin DATE NOT NULL, date_entree DATE NOT NULL, contrat VARCHAR(100) DEFAULT NULL, deleted SMALLINT NOT NULL, delete_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_direction (service_id INT NOT NULL, direction_id INT NOT NULL, INDEX IDX_66DBEBF9ED5CA9E6 (service_id), INDEX IDX_66DBEBF9AF73D997 (direction_id), PRIMARY KEY(service_id, direction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service_direction ADD CONSTRAINT FK_66DBEBF9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_direction ADD CONSTRAINT FK_66DBEBF9AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_direction DROP FOREIGN KEY FK_66DBEBF9ED5CA9E6');
        $this->addSql('ALTER TABLE service_direction DROP FOREIGN KEY FK_66DBEBF9AF73D997');
        $this->addSql('DROP TABLE direction');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_direction');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_MATRICULE ON user');
    }
}
