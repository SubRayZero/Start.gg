<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423102527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `rank` ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `rank` ADD CONSTRAINT FK_8879E8E5296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8879E8E5296CD8AE ON `rank` (team_id)');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FE13113B2');
        $this->addSql('DROP INDEX UNIQ_C4E0A61FE13113B2 ON team');
        $this->addSql('ALTER TABLE team DROP ranked_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team ADD ranked_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FE13113B2 FOREIGN KEY (ranked_id) REFERENCES `rank` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4E0A61FE13113B2 ON team (ranked_id)');
        $this->addSql('ALTER TABLE `rank` DROP FOREIGN KEY FK_8879E8E5296CD8AE');
        $this->addSql('DROP INDEX UNIQ_8879E8E5296CD8AE ON `rank`');
        $this->addSql('ALTER TABLE `rank` DROP team_id');
    }
}
