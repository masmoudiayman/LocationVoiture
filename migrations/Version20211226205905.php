<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211226205905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559B97F6AD');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955E50D1B2E');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559B97F6AD FOREIGN KEY (pk_client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E50D1B2E FOREIGN KEY (pk_voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559B97F6AD');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955E50D1B2E');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559B97F6AD FOREIGN KEY (pk_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E50D1B2E FOREIGN KEY (pk_voiture_id) REFERENCES voiture (id)');
    }
}
