<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113102304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe_decole (id INT AUTO_INCREMENT NOT NULL, moyenne_classe INT NOT NULL, numero_classe INT NOT NULL, nb_eleves INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eleve ADD classe_decole_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7C41F4056 FOREIGN KEY (classe_decole_id) REFERENCES classe_decole (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7C41F4056 ON eleve (classe_decole_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7C41F4056');
        $this->addSql('DROP TABLE classe_decole');
        $this->addSql('DROP INDEX IDX_ECA105F7C41F4056 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP classe_decole_id');
    }
}
