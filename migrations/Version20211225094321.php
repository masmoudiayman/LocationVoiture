<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225094321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD pk_client_id INT DEFAULT NULL, ADD pk_voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559B97F6AD FOREIGN KEY (pk_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E50D1B2E FOREIGN KEY (pk_voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_42C849559B97F6AD ON reservation (pk_client_id)');
        $this->addSql('CREATE INDEX IDX_42C84955E50D1B2E ON reservation (pk_voiture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559B97F6AD');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955E50D1B2E');
        $this->addSql('DROP INDEX IDX_42C849559B97F6AD ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955E50D1B2E ON reservation');
        $this->addSql('ALTER TABLE reservation DROP pk_client_id, DROP pk_voiture_id');
    }
}
