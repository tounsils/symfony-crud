<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180215223707 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__board AS SELECT id, name, description FROM board');
        $this->addSql('DROP TABLE board');
        $this->addSql('CREATE TABLE board (id INTEGER NOT NULL, name VARCHAR(100) NOT NULL COLLATE BINARY, description CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO board (id, name, description) SELECT id, name, description FROM __temp__board');
        $this->addSql('DROP TABLE __temp__board');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__board AS SELECT id, name, description FROM board');
        $this->addSql('DROP TABLE board');
        $this->addSql('CREATE TABLE board (id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO board (id, name, description) SELECT id, name, description FROM __temp__board');
        $this->addSql('DROP TABLE __temp__board');
    }
}
