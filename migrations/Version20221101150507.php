<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221101150507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD brochure_filename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE freelance DROP cv, DROP cv_file');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP brochure_filename');
        $this->addSql('ALTER TABLE freelance ADD cv VARCHAR(255) NOT NULL, ADD cv_file VARCHAR(255) NOT NULL');
    }
}
