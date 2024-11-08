<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241108121216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CCBBB7D3AD');
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CCD3A94C08');
        $this->addSql('DROP INDEX IDX_FD8521CCBBB7D3AD ON association');
        $this->addSql('DROP INDEX IDX_FD8521CCD3A94C08 ON association');
        $this->addSql('ALTER TABLE association ADD commune_id INT NOT NULL, ADD type_association_id INT NOT NULL, DROP commune_id_id, DROP type_assocation_id_id, CHANGE besoin besoin LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CC131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CCB97AE131 FOREIGN KEY (type_association_id) REFERENCES type_association (id)');
        $this->addSql('CREATE INDEX IDX_FD8521CC131A4F72 ON association (commune_id)');
        $this->addSql('CREATE INDEX IDX_FD8521CCB97AE131 ON association (type_association_id)');
        $this->addSql('ALTER TABLE commune ADD district_id INT DEFAULT NULL, DROP district_id_id, CHANGE nom nom VARCHAR(150) NOT NULL');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEB08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
        $this->addSql('CREATE INDEX IDX_E2E2D1EEB08FA272 ON commune (district_id)');
        $this->addSql('ALTER TABLE district CHANGE nom nom VARCHAR(150) NOT NULL');
        $this->addSql('ALTER TABLE region CHANGE nom nom VARCHAR(150) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CC131A4F72');
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CCB97AE131');
        $this->addSql('DROP INDEX IDX_FD8521CC131A4F72 ON association');
        $this->addSql('DROP INDEX IDX_FD8521CCB97AE131 ON association');
        $this->addSql('ALTER TABLE association ADD commune_id_id INT NOT NULL, ADD type_assocation_id_id INT NOT NULL, DROP commune_id, DROP type_association_id, CHANGE besoin besoin LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CCBBB7D3AD FOREIGN KEY (commune_id_id) REFERENCES commune (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CCD3A94C08 FOREIGN KEY (type_assocation_id_id) REFERENCES type_association (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FD8521CCBBB7D3AD ON association (commune_id_id)');
        $this->addSql('CREATE INDEX IDX_FD8521CCD3A94C08 ON association (type_assocation_id_id)');
        $this->addSql('ALTER TABLE region CHANGE nom nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EEB08FA272');
        $this->addSql('DROP INDEX IDX_E2E2D1EEB08FA272 ON commune');
        $this->addSql('ALTER TABLE commune ADD district_id_id INT NOT NULL, DROP district_id, CHANGE nom nom VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE district CHANGE nom nom VARCHAR(255) NOT NULL');
    }
}
