<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181027161920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX profesion_UNIQUE ON profesion');
        $this->addSql('ALTER TABLE profesion CHANGE nombre nombre VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE profesion RENAME INDEX nombre_unique TO UNIQ_7CBDAD0A3A909126');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profesion CHANGE nombre nombre VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci');
        $this->addSql('CREATE UNIQUE INDEX profesion_UNIQUE ON profesion (id)');
        $this->addSql('ALTER TABLE profesion RENAME INDEX uniq_7cbdad0a3a909126 TO nombre_UNIQUE');
    }
}
