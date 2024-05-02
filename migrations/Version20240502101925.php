<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502101925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `rank` DROP FOREIGN KEY FK_8879E8E5296CD8AE');
        $this->addSql('ALTER TABLE `rank` DROP FOREIGN KEY FK_8879E8E55DAC5993');
        $this->addSql('DROP TABLE `rank`');
        $this->addSql('ALTER TABLE user ADD number INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `rank` (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, inscription_id INT DEFAULT NULL, number INT NOT NULL, UNIQUE INDEX UNIQ_8879E8E5296CD8AE (team_id), UNIQUE INDEX UNIQ_8879E8E55DAC5993 (inscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `rank` ADD CONSTRAINT FK_8879E8E5296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `rank` ADD CONSTRAINT FK_8879E8E55DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user DROP number');
    }
}
