<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603125050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medico (id INT AUTO_INCREMENT NOT NULL, estado_id INT NOT NULL, apellido VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, matricula VARCHAR(255) NOT NULL, INDEX IDX_34E5914C9F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medico ADD CONSTRAINT FK_34E5914C9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE turno CHANGE medico medico_id INT NOT NULL');
        $this->addSql('ALTER TABLE turno ADD CONSTRAINT FK_E7976762A7FB1C0C FOREIGN KEY (medico_id) REFERENCES medico (id)');
        $this->addSql('CREATE INDEX IDX_E7976762A7FB1C0C ON turno (medico_id)');
        $this->addSql('ALTER TABLE user DROP matricula, DROP especialidad');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE turno DROP FOREIGN KEY FK_E7976762A7FB1C0C');
        $this->addSql('ALTER TABLE medico DROP FOREIGN KEY FK_34E5914C9F5A440B');
        $this->addSql('DROP TABLE medico');
        $this->addSql('DROP INDEX IDX_E7976762A7FB1C0C ON turno');
        $this->addSql('ALTER TABLE turno CHANGE medico_id medico INT NOT NULL');
        $this->addSql('ALTER TABLE `user` ADD matricula VARCHAR(255) DEFAULT NULL, ADD especialidad VARCHAR(255) DEFAULT NULL');
    }
}
