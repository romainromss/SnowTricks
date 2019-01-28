<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190114132759 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE tricks (id UUID NOT NULL, user_id UUID DEFAULT NULL, name VARCHAR(20) NOT NULL, description TEXT NOT NULL, category VARCHAR(20) NOT NULL, slug VARCHAR(100) NOT NULL, createdAt BIGINT NOT NULL, updatedAt BIGINT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1D902C1A76ED395 ON tricks (user_id)');
        $this->addSql('COMMENT ON COLUMN tricks.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN tricks.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE trick_movies (trick_id UUID NOT NULL, movie_id UUID NOT NULL, PRIMARY KEY(trick_id, movie_id))');
        $this->addSql('CREATE INDEX IDX_9D0B6C2DB281BE2E ON trick_movies (trick_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D0B6C2D8F93B6FC ON trick_movies (movie_id)');
        $this->addSql('COMMENT ON COLUMN trick_movies.trick_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN trick_movies.movie_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE trick_pictures (trick_id UUID NOT NULL, picture_id UUID NOT NULL, PRIMARY KEY(trick_id, picture_id))');
        $this->addSql('CREATE INDEX IDX_EAAFAB7FB281BE2E ON trick_pictures (trick_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EAAFAB7FEE45BDBF ON trick_pictures (picture_id)');
        $this->addSql('COMMENT ON COLUMN trick_pictures.trick_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN trick_pictures.picture_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE comments (id UUID NOT NULL, trick_id UUID DEFAULT NULL, user_id UUID DEFAULT NULL, content VARCHAR(200) NOT NULL, createdAt INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F9E962AB281BE2E ON comments (trick_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AA76ED395 ON comments (user_id)');
        $this->addSql('COMMENT ON COLUMN comments.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN comments.trick_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN comments.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, picture_id UUID DEFAULT NULL, username VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, password VARCHAR(65) NOT NULL, email VARCHAR(50) NOT NULL, emailToken VARCHAR(100) DEFAULT NULL, passwordResetToken VARCHAR(150) DEFAULT NULL, role VARCHAR(255) NOT NULL, createdAt INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1483A5E9EE45BDBF ON users (picture_id)');
        $this->addSql('CREATE INDEX username_idx ON users (username)');
        $this->addSql('CREATE INDEX email_idx ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users.picture_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE movies (id UUID NOT NULL, embed VARCHAR(100) NOT NULL, legend VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX embed_idx ON movies (embed)');
        $this->addSql('COMMENT ON COLUMN movies.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE pictures (id UUID NOT NULL, name VARCHAR(50) DEFAULT NULL, legend VARCHAR(50) NOT NULL, first BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX name_idx ON pictures (name)');
        $this->addSql('COMMENT ON COLUMN pictures.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C1A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick_movies ADD CONSTRAINT FK_9D0B6C2DB281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick_movies ADD CONSTRAINT FK_9D0B6C2D8F93B6FC FOREIGN KEY (movie_id) REFERENCES movies (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick_pictures ADD CONSTRAINT FK_EAAFAB7FB281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick_pictures ADD CONSTRAINT FK_EAAFAB7FEE45BDBF FOREIGN KEY (picture_id) REFERENCES pictures (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AB281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9EE45BDBF FOREIGN KEY (picture_id) REFERENCES pictures (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE trick_movies DROP CONSTRAINT FK_9D0B6C2DB281BE2E');
        $this->addSql('ALTER TABLE trick_pictures DROP CONSTRAINT FK_EAAFAB7FB281BE2E');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962AB281BE2E');
        $this->addSql('ALTER TABLE tricks DROP CONSTRAINT FK_E1D902C1A76ED395');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE trick_movies DROP CONSTRAINT FK_9D0B6C2D8F93B6FC');
        $this->addSql('ALTER TABLE trick_pictures DROP CONSTRAINT FK_EAAFAB7FEE45BDBF');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9EE45BDBF');
        $this->addSql('DROP TABLE tricks');
        $this->addSql('DROP TABLE trick_movies');
        $this->addSql('DROP TABLE trick_pictures');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE pictures');
    }
}
