<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322114339 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD createdAt INT NOT NULL, DROP created_at');
        $this->addSql('ALTER TABLE comments ADD createdAt INT NOT NULL, DROP created_at');
        $this->addSql('ALTER TABLE tricks ADD createdAt INT NOT NULL, ADD updatedAt INT NOT NULL, DROP created_at, DROP updated_at, DROP slug');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments ADD created_at VARCHAR(20) NOT NULL COLLATE utf8_unicode_ci, DROP createdAt');
        $this->addSql('ALTER TABLE tricks ADD created_at VARCHAR(20) NOT NULL COLLATE utf8_unicode_ci, ADD updated_at VARCHAR(20) NOT NULL COLLATE utf8_unicode_ci, ADD slug VARCHAR(50) NOT NULL COLLATE utf8_unicode_ci, DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE users ADD created_at VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP createdAt');
    }
}
