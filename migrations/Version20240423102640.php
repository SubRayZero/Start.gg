<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423102640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `rank` ADD inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `rank` ADD CONSTRAINT FK_8879E8E55DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8879E8E55DAC5993 ON `rank` (inscription_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `rank` DROP FOREIGN KEY FK_8879E8E55DAC5993');
        $this->addSql('DROP INDEX UNIQ_8879E8E55DAC5993 ON `rank`');
        $this->addSql('ALTER TABLE `rank` DROP inscription_id');
    }
}
