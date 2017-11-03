<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171031145954 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fahrzeugdatenblatt CHANGE personen_max personen_max INT DEFAULT NULL, CHANGE gepaeck_max gepaeck_max INT DEFAULT NULL, CHANGE preis_km preis_km INT DEFAULT NULL, CHANGE preis_stunde preis_stunde INT DEFAULT NULL, CHANGE preis_grund preis_grund INT DEFAULT NULL, CHANGE bild_fahrzeug bild_fahrzeug VARCHAR(255) DEFAULT NULL, CHANGE zusatzinfos zusatzinfos LONGTEXT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fahrzeugdatenblatt CHANGE personen_max personen_max INT NOT NULL, CHANGE gepaeck_max gepaeck_max INT NOT NULL, CHANGE preis_km preis_km INT NOT NULL, CHANGE preis_stunde preis_stunde INT NOT NULL, CHANGE preis_grund preis_grund INT NOT NULL, CHANGE bild_fahrzeug bild_fahrzeug VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE zusatzinfos zusatzinfos LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
    }
}
