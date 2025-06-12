<?php

declare(strict_types=1);

namespace DoctrineMigrations\Catalog;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250612042520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE brand (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, status VARCHAR(255) NOT NULL, meta_title VARCHAR(255) NOT NULL, meta_description VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', parent_category_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(70) NOT NULL, meta_title VARCHAR(255) NOT NULL, meta_description VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_64C19C1796A8F92 (parent_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE inventory (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', quantity_evailable INT NOT NULL, quantity_reserved INT NOT NULL, low_stock_threshold INT NOT NULL, last_updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE product (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', category_id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', sku VARCHAR(20) NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', weight DOUBLE PRECISION NOT NULL, dimentions VARCHAR(255) DEFAULT NULL, tax_category VARCHAR(50) DEFAULT NULL, meta_title VARCHAR(255) NOT NULL, meta_description VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE product_variant (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', inventory_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', price DOUBLE PRECISION NOT NULL, sku VARCHAR(20) NOT NULL, variant_status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_209AA41D9EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE variant_attribute (id INT AUTO_INCREMENT NOT NULL, product_variant_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', label VARCHAR(20) NOT NULL, INDEX IDX_198634A8A80EF684 (product_variant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category ADD CONSTRAINT FK_64C19C1796A8F92 FOREIGN KEY (parent_category_id) REFERENCES category (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_variant ADD CONSTRAINT FK_209AA41D9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE variant_attribute ADD CONSTRAINT FK_198634A8A80EF684 FOREIGN KEY (product_variant_id) REFERENCES product_variant (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE category DROP FOREIGN KEY FK_64C19C1796A8F92
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_variant DROP FOREIGN KEY FK_209AA41D9EEA759
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE variant_attribute DROP FOREIGN KEY FK_198634A8A80EF684
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE brand
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE inventory
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product_variant
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE variant_attribute
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
