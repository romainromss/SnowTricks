<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416120426 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pictures CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE users_id users_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE trick_id trick_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE name name VARCHAR(20) DEFAULT NULL, CHANGE legend legend VARCHAR(50) NOT NULL, CHANGE avatar avatar VARCHAR(50) DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC067B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC0B281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F7C2FC067B3B43D ON pictures (users_id)');
        $this->addSql('CREATE INDEX IDX_8F7C2FC0B281BE2E ON pictures (trick_id)');
        $this->addSql('CREATE INDEX avatar_idx ON pictures (avatar)');
        $this->addSql('CREATE INDEX name_idx ON pictures (name)');
        $this->addSql('ALTER TABLE movies CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE trick_id trick_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE embed embed VARCHAR(100) NOT NULL, CHANGE legend legend VARCHAR(50) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE movies ADD CONSTRAINT FK_C61EED30B281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id)');
        $this->addSql('CREATE INDEX IDX_C61EED30B281BE2E ON movies (trick_id)');
        $this->addSql('CREATE INDEX embed_idx ON movies (embed)');
        $this->addSql('ALTER TABLE users CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE username username VARCHAR(10) NOT NULL, CHANGE name name VARCHAR(10) NOT NULL, CHANGE lastname lastname VARCHAR(20) NOT NULL, CHANGE password password VARCHAR(65) NOT NULL, CHANGE email email VARCHAR(50) NOT NULL, CHANGE role role VARCHAR(255) NOT NULL, CHANGE createdAt createdAt INT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE INDEX username_idx ON users (username)');
        $this->addSql('CREATE INDEX password_idx ON users (password)');
        $this->addSql('ALTER TABLE comments CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE trick_id trick_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE users_id users_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE content content VARCHAR(200) NOT NULL, CHANGE createdAt createdAt INT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AB281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AB281BE2E ON comments (trick_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A67B3B43D ON comments (users_id)');
        $this->addSql('ALTER TABLE tricks CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE users_id users_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE name name VARCHAR(20) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE `group` `group` VARCHAR(20) NOT NULL, CHANGE createdAt createdAt BIGINT NOT NULL, CHANGE updatedAt updatedAt BIGINT NOT NULL, CHANGE slug slug VARCHAR(100) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C167B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_E1D902C167B3B43D ON tricks (users_id)');
        $this->addSql('CREATE INDEX name_idx ON tricks (name)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AB281BE2E');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A67B3B43D');
        $this->addSql('DROP INDEX IDX_5F9E962AB281BE2E ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962A67B3B43D ON comments');
        $this->addSql('ALTER TABLE comments DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE comments CHANGE id id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE trick_id trick_id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE users_id users_id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE content content VARCHAR(200) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE createdAt createdAt INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movies DROP FOREIGN KEY FK_C61EED30B281BE2E');
        $this->addSql('DROP INDEX IDX_C61EED30B281BE2E ON movies');
        $this->addSql('ALTER TABLE movies DROP PRIMARY KEY');
        $this->addSql('DROP INDEX embed_idx ON movies');
        $this->addSql('ALTER TABLE movies CHANGE id id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE trick_id trick_id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE embed embed TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE legend legend TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC067B3B43D');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC0B281BE2E');
        $this->addSql('DROP INDEX UNIQ_8F7C2FC067B3B43D ON pictures');
        $this->addSql('DROP INDEX IDX_8F7C2FC0B281BE2E ON pictures');
        $this->addSql('ALTER TABLE pictures DROP PRIMARY KEY');
        $this->addSql('DROP INDEX avatar_idx ON pictures');
        $this->addSql('DROP INDEX name_idx ON pictures');
        $this->addSql('ALTER TABLE pictures CHANGE id id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE users_id users_id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE trick_id trick_id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE name name TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE legend legend TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE avatar avatar TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C167B3B43D');
        $this->addSql('DROP INDEX IDX_E1D902C167B3B43D ON tricks');
        $this->addSql('ALTER TABLE tricks DROP PRIMARY KEY');
        $this->addSql('DROP INDEX name_idx ON tricks');
        $this->addSql('ALTER TABLE tricks CHANGE id id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE users_id users_id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE name name TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE description description VARCHAR(21845) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE `group` `group` TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE slug slug TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE createdAt createdAt BIGINT DEFAULT NULL, CHANGE updatedAt updatedAt BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE users DROP PRIMARY KEY');
        $this->addSql('DROP INDEX username_idx ON users');
        $this->addSql('DROP INDEX password_idx ON users');
        $this->addSql('ALTER TABLE users CHANGE id id CHAR(36) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE username username TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE name name TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE lastname lastname TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE password password TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE email email TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE role role VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE createdAt createdAt INT DEFAULT NULL');
    }
}
