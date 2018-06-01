<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180601064700 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX name');
        $this->addSql('DROP INDEX idx_e1d902c15e237e06');
        $this->addSql('DROP INDEX name_idx');
        $this->addSql('ALTER TABLE tricks ALTER updatedat SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tricks ALTER updatedAt DROP NOT NULL');
        $this->addSql('CREATE INDEX name ON tricks (name)');
        $this->addSql('CREATE INDEX idx_e1d902c15e237e06 ON tricks (name)');
        $this->addSql('CREATE INDEX name_idx ON tricks (name)');
    }
}
