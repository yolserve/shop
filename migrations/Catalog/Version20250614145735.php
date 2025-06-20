<?php

declare(strict_types=1);

namespace DoctrineMigrations\Catalog;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250614145735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE category ADD thumbnail_url VARCHAR(255) NOT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD inventory_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', ADD price DOUBLE PRECISION NOT NULL, ADD bar_code VARCHAR(255) NOT NULL, ADD thumbnail VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_D34A04AD9EEA759 ON product (inventory_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD9EEA759
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_D34A04AD9EEA759 ON product
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP inventory_id, DROP price, DROP bar_code, DROP thumbnail
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category DROP thumbnail_url, DROP updated_at
        SQL);
    }
}
