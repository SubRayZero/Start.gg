<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423102804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD ranked_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7E13113B2 FOREIGN KEY (ranked_id) REFERENCES `rank` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA7E13113B2 ON event (ranked_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7E13113B2');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA7E13113B2 ON event');
        $this->addSql('ALTER TABLE event DROP ranked_id');
    }
}
