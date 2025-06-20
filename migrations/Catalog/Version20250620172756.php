<?php

declare(strict_types=1);

namespace DoctrineMigrations\Catalog;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250620172756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD has_variants TINYINT(1) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_variant ADD product_id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_variant ADD CONSTRAINT FK_209AA41D4584665A FOREIGN KEY (product_id) REFERENCES product (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_209AA41D4584665A ON product_variant (product_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE variant_attribute ADD value VARCHAR(20) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP has_variants
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_variant DROP FOREIGN KEY FK_209AA41D4584665A
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_209AA41D4584665A ON product_variant
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_variant DROP product_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE variant_attribute DROP value
        SQL);
    }
}
