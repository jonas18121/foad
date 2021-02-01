<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201154821 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F42BCB999');
        $this->addSql('DROP INDEX IDX_B6BD307F42BCB999 ON message');
        $this->addSql('ALTER TABLE message CHANGE user_envoie_id user_received_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F113A2C60 FOREIGN KEY (user_received_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F113A2C60 ON message (user_received_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F113A2C60');
        $this->addSql('DROP INDEX IDX_B6BD307F113A2C60 ON message');
        $this->addSql('ALTER TABLE message CHANGE user_received_id user_envoie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F42BCB999 FOREIGN KEY (user_envoie_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F42BCB999 ON message (user_envoie_id)');
    }
}
