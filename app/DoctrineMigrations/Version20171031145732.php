<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171031145732 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, Testfeld1 VARCHAR(255) NOT NULL, Datum1 DATETIME NOT NULL, Time1 DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fahrzeugdatenblatt (id INT AUTO_INCREMENT NOT NULL, fahrzeug_marke VARCHAR(255) NOT NULL, fahrzeug_modell VARCHAR(255) NOT NULL, fahrzeug_kategorie VARCHAR(255) NOT NULL, personen_max INT NOT NULL, gepaeck_max INT NOT NULL, preis_km INT NOT NULL, preis_stunde INT NOT NULL, preis_grund INT NOT NULL, bild_fahrzeug VARCHAR(255) NOT NULL, zusatzinfos LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testkiki (id INT AUTO_INCREMENT NOT NULL, Testfeld1 VARCHAR(255) NOT NULL, date1 DATETIME NOT NULL, date2 DATETIME NOT NULL, carID VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE fahrzeugdatenblatt');
        $this->addSql('DROP TABLE testkiki');
    }
}
