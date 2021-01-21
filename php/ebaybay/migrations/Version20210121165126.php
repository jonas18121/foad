<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121165126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE didding ADD product_id INT NOT NULL, ADD shopper_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE didding ADD CONSTRAINT FK_7A361ABE4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE didding ADD CONSTRAINT FK_7A361ABEFE2A96A4 FOREIGN KEY (shopper_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A361ABE4584665A ON didding (product_id)');
        $this->addSql('CREATE INDEX IDX_7A361ABEFE2A96A4 ON didding (shopper_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE didding DROP FOREIGN KEY FK_7A361ABE4584665A');
        $this->addSql('ALTER TABLE didding DROP FOREIGN KEY FK_7A361ABEFE2A96A4');
        $this->addSql('DROP INDEX UNIQ_7A361ABE4584665A ON didding');
        $this->addSql('DROP INDEX IDX_7A361ABEFE2A96A4 ON didding');
        $this->addSql('ALTER TABLE didding DROP product_id, DROP shopper_id');
    }
}
