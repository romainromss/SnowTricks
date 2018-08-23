<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180725220238 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE trick_pictures DROP CONSTRAINT FK_EAAFAB7FB281BE2E');
        $this->addSql('ALTER TABLE trick_pictures DROP CONSTRAINT FK_EAAFAB7FEE45BDBF');
        $this->addSql('ALTER TABLE trick_pictures ADD CONSTRAINT FK_EAAFAB7FB281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick_pictures ADD CONSTRAINT FK_EAAFAB7FEE45BDBF FOREIGN KEY (picture_id) REFERENCES pictures (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE trick_pictures DROP CONSTRAINT fk_eaafab7fb281be2e');
        $this->addSql('ALTER TABLE trick_pictures DROP CONSTRAINT fk_eaafab7fee45bdbf');
        $this->addSql('ALTER TABLE trick_pictures ADD CONSTRAINT fk_eaafab7fb281be2e FOREIGN KEY (trick_id) REFERENCES tricks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick_pictures ADD CONSTRAINT fk_eaafab7fee45bdbf FOREIGN KEY (picture_id) REFERENCES pictures (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
