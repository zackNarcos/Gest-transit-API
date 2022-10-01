<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928230415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colis ADD is_solde TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF91B65292 FOREIGN KEY (employe_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_470BDFF91B65292 ON colis (employe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF91B65292');
        $this->addSql('DROP INDEX IDX_470BDFF91B65292 ON colis');
        $this->addSql('ALTER TABLE colis DROP is_solde');
    }
}
