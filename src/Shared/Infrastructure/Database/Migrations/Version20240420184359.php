<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240420184359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coupons_coupon (ulid VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, value INTEGER NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DC3DEC0E5E237E06 ON coupons_coupon (name)');
        $this->addSql('CREATE TABLE products_product (ulid VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_877FEF05E237E06 ON products_product (name)');
        $this->addSql('CREATE TABLE tax_mask_taxes (ulid VARCHAR(26) NOT NULL, mask VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, tax DOUBLE PRECISION NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_506E6267F6FC330 ON tax_mask_taxes (mask)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coupons_coupon');
        $this->addSql('DROP TABLE products_product');
        $this->addSql('DROP TABLE tax_mask_taxes');
    }
}
