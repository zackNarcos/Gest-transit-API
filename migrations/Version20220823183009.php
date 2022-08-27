<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823183009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE colis (id INT AUTO_INCREMENT NOT NULL, destination_id INT NOT NULL, nom_expediteur VARCHAR(255) NOT NULL, prenom_expediteur VARCHAR(255) NOT NULL, telephone_expediteur VARCHAR(255) NOT NULL, npi_expediteur VARCHAR(255) NOT NULL, email_expediteur VARCHAR(255) NOT NULL, nom_beneficiaire VARCHAR(255) NOT NULL, prenom_beneficiaire VARCHAR(255) NOT NULL, telephone_beneficiaire VARCHAR(255) NOT NULL, poids DOUBLE PRECISION NOT NULL, emballage INT DEFAULT NULL, douane INT DEFAULT NULL, contenue VARCHAR(255) NOT NULL, valeur INT NOT NULL, prix_kilo INT NOT NULL, prix_total INT NOT NULL, INDEX IDX_470BDFF9816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF9816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF9816C6140');
        $this->addSql('DROP TABLE colis');
    }
}
