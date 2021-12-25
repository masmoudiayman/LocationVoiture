<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225141608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, pk_client_id INT DEFAULT NULL, pk_voiture_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, prix_par_jour BIGINT NOT NULL, INDEX IDX_42C84955E50D1B2E (pk_voiture_id), INDEX IDX_42C849559B97F6AD (pk_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559B97F6AD FOREIGN KEY (pk_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E50D1B2E FOREIGN KEY (pk_voiture_id) REFERENCES voiture (id)');
    }
}
