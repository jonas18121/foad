<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201153744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('DROP INDEX IDX_B6BD307FA76ED395 ON message');
        $this->addSql('ALTER TABLE message CHANGE user_id user_envoie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F42BCB999 FOREIGN KEY (user_envoie_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F42BCB999 ON message (user_envoie_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649831B0477');
        $this->addSql('DROP INDEX IDX_8D93D649831B0477 ON user');
        $this->addSql('ALTER TABLE user DROP message_send_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F42BCB999');
        $this->addSql('DROP INDEX IDX_B6BD307F42BCB999 ON message');
        $this->addSql('ALTER TABLE message CHANGE user_envoie_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FA76ED395 ON message (user_id)');
        $this->addSql('ALTER TABLE user ADD message_send_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649831B0477 FOREIGN KEY (message_send_id) REFERENCES message (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649831B0477 ON user (message_send_id)');
    }
}
