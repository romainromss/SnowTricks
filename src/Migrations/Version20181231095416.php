<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181231095416 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE tricks (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , user_id CHAR(36) DEFAULT NULL --(DC2Type:uuid)
        , name VARCHAR(20) NOT NULL, description CLOB NOT NULL, category VARCHAR(20) NOT NULL, slug VARCHAR(100) NOT NULL, createdAt BIGINT NOT NULL, updatedAt BIGINT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1D902C1A76ED395 ON tricks (user_id)');
        $this->addSql('CREATE TABLE trick_movies (trick_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , movie_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , PRIMARY KEY(trick_id, movie_id))');
        $this->addSql('CREATE INDEX IDX_9D0B6C2DB281BE2E ON trick_movies (trick_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D0B6C2D8F93B6FC ON trick_movies (movie_id)');
        $this->addSql('CREATE TABLE trick_pictures (trick_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , picture_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , PRIMARY KEY(trick_id, picture_id))');
        $this->addSql('CREATE INDEX IDX_EAAFAB7FB281BE2E ON trick_pictures (trick_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EAAFAB7FEE45BDBF ON trick_pictures (picture_id)');
        $this->addSql('CREATE TABLE comments (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , trick_id CHAR(36) DEFAULT NULL --(DC2Type:uuid)
        , user_id CHAR(36) DEFAULT NULL --(DC2Type:uuid)
        , content VARCHAR(200) NOT NULL, createdAt INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F9E962AB281BE2E ON comments (trick_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AA76ED395 ON comments (user_id)');
        $this->addSql('CREATE TABLE users (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , picture_id CHAR(36) DEFAULT NULL --(DC2Type:uuid)
        , username VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, password VARCHAR(65) NOT NULL, email VARCHAR(50) NOT NULL, emailToken VARCHAR(100) DEFAULT NULL, passwordResetToken VARCHAR(150) DEFAULT NULL, role VARCHAR(255) NOT NULL, createdAt INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1483A5E9EE45BDBF ON users (picture_id)');
        $this->addSql('CREATE INDEX username_idx ON users (username)');
        $this->addSql('CREATE INDEX email_idx ON users (email)');
        $this->addSql('CREATE TABLE movies (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , embed VARCHAR(100) NOT NULL, legend VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX embed_idx ON movies (embed)');
        $this->addSql('CREATE TABLE pictures (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(50) DEFAULT NULL, legend VARCHAR(50) NOT NULL, first BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX name_idx ON pictures (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE tricks');
        $this->addSql('DROP TABLE trick_movies');
        $this->addSql('DROP TABLE trick_pictures');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE pictures');
    }
}
