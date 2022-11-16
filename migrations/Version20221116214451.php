<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116214451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE voucher_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voucher_registry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voucher_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE voucher (id INT NOT NULL, type_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, amount INT NOT NULL, permanent BOOLEAN DEFAULT NULL, valid_from DATE DEFAULT NULL, valid_until DATE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1392A5D8C54C8C93 ON voucher (type_id)');
        $this->addSql('CREATE TABLE voucher_registry (id INT NOT NULL, voucher_id INT NOT NULL, user_name VARCHAR(255) NOT NULL, register_date DATE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_530F458328AA1B6F ON voucher_registry (voucher_id)');
        $this->addSql('CREATE TABLE voucher_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE voucher ADD CONSTRAINT FK_1392A5D8C54C8C93 FOREIGN KEY (type_id) REFERENCES voucher_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE voucher_registry ADD CONSTRAINT FK_530F458328AA1B6F FOREIGN KEY (voucher_id) REFERENCES voucher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE voucher_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voucher_registry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE voucher_type_id_seq CASCADE');
        $this->addSql('ALTER TABLE voucher DROP CONSTRAINT FK_1392A5D8C54C8C93');
        $this->addSql('ALTER TABLE voucher_registry DROP CONSTRAINT FK_530F458328AA1B6F');
        $this->addSql('DROP TABLE voucher');
        $this->addSql('DROP TABLE voucher_registry');
        $this->addSql('DROP TABLE voucher_type');
    }
}
