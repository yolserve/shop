<?php

declare(strict_types=1);

namespace DoctrineMigrations\Catalog;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250616034924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE inventory CHANGE quantity_evailable quantity_available INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD physical_product TINYINT(1) NOT NULL, CHANGE weight weight DOUBLE PRECISION DEFAULT NULL, CHANGE tax_category tax_category VARCHAR(255) NOT NULL, CHANGE dimentions dimensions VARCHAR(255) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP physical_product, CHANGE weight weight DOUBLE PRECISION NOT NULL, CHANGE tax_category tax_category VARCHAR(50) DEFAULT NULL, CHANGE dimensions dimentions VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inventory CHANGE quantity_available quantity_evailable INT NOT NULL
        SQL);
    }
}
