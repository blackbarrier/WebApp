<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603120500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE estado_turno (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turno (id INT AUTO_INCREMENT NOT NULL, estado_id INT NOT NULL, fecha DATETIME NOT NULL, fecha_solicitado DATETIME NOT NULL, paciente INT NOT NULL, medico INT NOT NULL, descripcion VARCHAR(255) NOT NULL, severidad INT NOT NULL, INDEX IDX_E79767629F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE turno ADD CONSTRAINT FK_E79767629F5A440B FOREIGN KEY (estado_id) REFERENCES estado_turno (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE turno DROP FOREIGN KEY FK_E79767629F5A440B');
        $this->addSql('DROP TABLE estado_turno');
        $this->addSql('DROP TABLE turno');
    }
}
