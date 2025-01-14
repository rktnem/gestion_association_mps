<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250112171801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association ADD nom_president VARCHAR(255) NOT NULL, ADD nif_stat TINYINT(1) NOT NULL, ADD numero_recepisse VARCHAR(150) NOT NULL, DROP besoin_default');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CC131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CC131A4F72');
        $this->addSql('ALTER TABLE association ADD besoin_default LONGTEXT NOT NULL, DROP nom_president, DROP nif_stat, DROP numero_recepisse');
    }
}
