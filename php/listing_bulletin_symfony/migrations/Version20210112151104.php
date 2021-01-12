<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210112151104 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe_decole DROP nb_eleves');
        $this->addSql('ALTER TABLE eleve ADD classe_decole_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7C41F4056 FOREIGN KEY (classe_decole_id) REFERENCES classe_decole (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7C41F4056 ON eleve (classe_decole_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe_decole ADD nb_eleves INT NOT NULL');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7C41F4056');
        $this->addSql('DROP INDEX IDX_ECA105F7C41F4056 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP classe_decole_id');
    }
}
