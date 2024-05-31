<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531160029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD obrasocial_id INT DEFAULT NULL, DROP edad');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496317708B FOREIGN KEY (obrasocial_id) REFERENCES obrasocial (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496317708B ON user (obrasocial_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6496317708B');
        $this->addSql('DROP INDEX IDX_8D93D6496317708B ON `user`');
        $this->addSql('ALTER TABLE `user` ADD edad INT NOT NULL, DROP obrasocial_id');
    }
}
