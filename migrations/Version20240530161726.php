<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530161726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE estado (id INT AUTO_INCREMENT NOT NULL, estado VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE obrasocial (id INT AUTO_INCREMENT NOT NULL, obra_social VARCHAR(255) NOT NULL, nombre_completo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD borrado TINYINT(1) NOT NULL, ADD apellido VARCHAR(255) NOT NULL, ADD nombre VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD matricula VARCHAR(255) DEFAULT NULL, ADD especialidad VARCHAR(255) DEFAULT NULL, ADD telefono INT NOT NULL, ADD domicilio VARCHAR(255) DEFAULT NULL, ADD edad INT NOT NULL, ADD fnac DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE estado');
        $this->addSql('DROP TABLE obrasocial');
        $this->addSql('ALTER TABLE `user` DROP borrado, DROP apellido, DROP nombre, DROP email, DROP matricula, DROP especialidad, DROP telefono, DROP domicilio, DROP edad, DROP fnac');
    }
}
