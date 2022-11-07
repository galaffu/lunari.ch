<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221101090627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE freelance ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE freelance ADD CONSTRAINT FK_48ABC675A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_48ABC675A76ED395 ON freelance (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE freelance DROP FOREIGN KEY FK_48ABC675A76ED395');
        $this->addSql('DROP INDEX UNIQ_48ABC675A76ED395 ON freelance');
        $this->addSql('ALTER TABLE freelance DROP user_id');
    }
}
