<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201140739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message ADD user_send_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4B9E2071 FOREIGN KEY (user_send_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6BD307F4B9E2071 ON message (user_send_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F4B9E2071');
        $this->addSql('DROP INDEX UNIQ_B6BD307F4B9E2071 ON message');
        $this->addSql('ALTER TABLE message DROP user_send_id');
    }
}
