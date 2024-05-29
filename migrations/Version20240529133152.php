<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529133152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rol (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, short VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, rol_id INT NOT NULL, dni VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_8D93D6494BAB96C (rol_id), UNIQUE INDEX UNIQ_IDENTIFIER_DNI (dni), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6494BAB96C FOREIGN KEY (rol_id) REFERENCES rol (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6494BAB96C');
        $this->addSql('DROP TABLE rol');
        $this->addSql('DROP TABLE `user`');
    }
}
