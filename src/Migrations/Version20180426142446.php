<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180426142446 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pictures (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', users_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', trick_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(20) DEFAULT NULL, legend VARCHAR(50) NOT NULL, avatar VARCHAR(50) DEFAULT NULL, first TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_8F7C2FC067B3B43D (users_id), INDEX IDX_8F7C2FC0B281BE2E (trick_id), INDEX avatar_idx (avatar), INDEX name_idx (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', trick_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', embed VARCHAR(100) NOT NULL, legend VARCHAR(50) NOT NULL, INDEX IDX_C61EED30B281BE2E (trick_id), INDEX embed_idx (embed), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', username VARCHAR(10) NOT NULL, name VARCHAR(10) NOT NULL, lastname VARCHAR(20) NOT NULL, password VARCHAR(65) NOT NULL, email VARCHAR(50) NOT NULL, role VARCHAR(255) NOT NULL, createdAt INT NOT NULL, INDEX username_idx (username), INDEX password_idx (password), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', trick_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', users_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', content VARCHAR(200) NOT NULL, createdAt INT NOT NULL, INDEX IDX_5F9E962AB281BE2E (trick_id), INDEX IDX_5F9E962A67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tricks (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', users_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(20) NOT NULL, description LONGTEXT NOT NULL, `group` VARCHAR(20) NOT NULL, slug VARCHAR(100) NOT NULL, createdAt BIGINT NOT NULL, updatedAt BIGINT NOT NULL, INDEX IDX_E1D902C167B3B43D (users_id), INDEX name_idx (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC067B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC0B281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE movies ADD CONSTRAINT FK_C61EED30B281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AB281BE2E FOREIGN KEY (trick_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C167B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC067B3B43D');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A67B3B43D');
        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C167B3B43D');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC0B281BE2E');
        $this->addSql('ALTER TABLE movies DROP FOREIGN KEY FK_C61EED30B281BE2E');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AB281BE2E');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE tricks');
    }
}
