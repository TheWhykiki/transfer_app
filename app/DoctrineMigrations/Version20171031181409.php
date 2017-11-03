<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171031181409 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transferfahrten ADD fahrten_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transferfahrten ADD CONSTRAINT FK_A38E87448F0AD852 FOREIGN KEY (fahrten_id) REFERENCES fahrzeugdatenblatt (id)');
        $this->addSql('CREATE INDEX IDX_A38E87448F0AD852 ON transferfahrten (fahrten_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transferfahrten DROP FOREIGN KEY FK_A38E87448F0AD852');
        $this->addSql('DROP INDEX IDX_A38E87448F0AD852 ON transferfahrten');
        $this->addSql('ALTER TABLE transferfahrten DROP fahrten_id');
    }
}
