<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181120131321 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

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
        $this->addSql('CREATE TABLE user_pictures (user_id UUID NOT NULL, picture_id UUID NOT NULL, PRIMARY KEY(user_id, picture_id))');
        $this->addSql('CREATE INDEX IDX_6FF1CBC0A76ED395 ON user_pictures (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FF1CBC0EE45BDBF ON user_pictures (picture_id)');
        $this->addSql('COMMENT ON COLUMN user_pictures.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_pictures.picture_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE trick_movies ADD CONSTRAINT FK_9D0B6C2DB281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick_movies ADD CONSTRAINT FK_9D0B6C2D8F93B6FC FOREIGN KEY (movie_id) REFERENCES movies (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick_pictures ADD CONSTRAINT FK_EAAFAB7FB281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick_pictures ADD CONSTRAINT FK_EAAFAB7FEE45BDBF FOREIGN KEY (picture_id) REFERENCES pictures (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_pictures ADD CONSTRAINT FK_6FF1CBC0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_pictures ADD CONSTRAINT FK_6FF1CBC0EE45BDBF FOREIGN KEY (picture_id) REFERENCES pictures (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tricks DROP CONSTRAINT fk_e1d902c167b3b43d');
        $this->addSql('DROP INDEX idx_e1d902c167b3b43d');
        $this->addSql('ALTER TABLE tricks ALTER updatedat DROP NOT NULL');
        $this->addSql('ALTER TABLE tricks RENAME COLUMN users_id TO user_id');
        $this->addSql('ALTER TABLE tricks RENAME COLUMN "group" TO category');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C1A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E1D902C1A76ED395 ON tricks (user_id)');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT fk_5f9e962a67b3b43d');
        $this->addSql('DROP INDEX idx_5f9e962a67b3b43d');
        $this->addSql('ALTER TABLE comments RENAME COLUMN users_id TO user_id');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5F9E962AA76ED395 ON comments (user_id)');
        $this->addSql('DROP INDEX password_idx');
        $this->addSql('CREATE INDEX email_idx ON users (email)');
        $this->addSql('ALTER TABLE movies DROP CONSTRAINT fk_c61eed30b281be2e');
        $this->addSql('DROP INDEX idx_c61eed30b281be2e');
        $this->addSql('ALTER TABLE movies DROP trick_id');
        $this->addSql('ALTER TABLE pictures DROP CONSTRAINT fk_8f7c2fc067b3b43d');
        $this->addSql('ALTER TABLE pictures DROP CONSTRAINT fk_8f7c2fc0b281be2e');
        $this->addSql('DROP INDEX avatar_idx');
        $this->addSql('DROP INDEX first_idx');
        $this->addSql('DROP INDEX uniq_8f7c2fc067b3b43d');
        $this->addSql('DROP INDEX trick_id_idx');
        $this->addSql('ALTER TABLE pictures DROP users_id');
        $this->addSql('ALTER TABLE pictures DROP trick_id');
        $this->addSql('ALTER TABLE pictures DROP avatar');
        $this->addSql('ALTER TABLE pictures ALTER name TYPE VARCHAR(50)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE trick_movies');
        $this->addSql('DROP TABLE trick_pictures');
        $this->addSql('DROP TABLE user_pictures');
        $this->addSql('ALTER TABLE pictures ADD users_id UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE pictures ADD trick_id UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE pictures ADD avatar VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE pictures ALTER name TYPE VARCHAR(20)');
        $this->addSql('COMMENT ON COLUMN pictures.users_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN pictures.trick_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT fk_8f7c2fc067b3b43d FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT fk_8f7c2fc0b281be2e FOREIGN KEY (trick_id) REFERENCES tricks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX avatar_idx ON pictures (avatar)');
        $this->addSql('CREATE INDEX first_idx ON pictures (first)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8f7c2fc067b3b43d ON pictures (users_id)');
        $this->addSql('CREATE INDEX trick_id_idx ON pictures (trick_id)');
        $this->addSql('ALTER TABLE movies ADD trick_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN movies.trick_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE movies ADD CONSTRAINT fk_c61eed30b281be2e FOREIGN KEY (trick_id) REFERENCES tricks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c61eed30b281be2e ON movies (trick_id)');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962AA76ED395');
        $this->addSql('DROP INDEX IDX_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE comments RENAME COLUMN user_id TO users_id');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT fk_5f9e962a67b3b43d FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5f9e962a67b3b43d ON comments (users_id)');
        $this->addSql('DROP INDEX email_idx');
        $this->addSql('CREATE INDEX password_idx ON users (password)');
        $this->addSql('ALTER TABLE tricks DROP CONSTRAINT FK_E1D902C1A76ED395');
        $this->addSql('DROP INDEX IDX_E1D902C1A76ED395');
        $this->addSql('ALTER TABLE tricks ALTER updatedAt SET NOT NULL');
        $this->addSql('ALTER TABLE tricks RENAME COLUMN user_id TO users_id');
        $this->addSql('ALTER TABLE tricks RENAME COLUMN category TO "group"');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT fk_e1d902c167b3b43d FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e1d902c167b3b43d ON tricks (users_id)');
    }
}
