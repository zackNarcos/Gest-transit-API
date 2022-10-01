<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928234216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reliquat (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, coli_id INT DEFAULT NULL, montant INT NOT NULL, date DATE NOT NULL, INDEX IDX_13FA725A1B65292 (employe_id), UNIQUE INDEX UNIQ_13FA725A5D7C0A6E (coli_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reliquat ADD CONSTRAINT FK_13FA725A1B65292 FOREIGN KEY (employe_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reliquat ADD CONSTRAINT FK_13FA725A5D7C0A6E FOREIGN KEY (coli_id) REFERENCES colis (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reliquat DROP FOREIGN KEY FK_13FA725A1B65292');
        $this->addSql('ALTER TABLE reliquat DROP FOREIGN KEY FK_13FA725A5D7C0A6E');
        $this->addSql('DROP TABLE reliquat');
    }
}
