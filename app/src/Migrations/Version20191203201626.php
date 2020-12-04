<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191203201626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE albums ADD artist_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE albums ADD CONSTRAINT FK_F4E2474FB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id)');
        $this->addSql('CREATE INDEX IDX_F4E2474FB7970CF8 ON albums (artist_id)');
        $this->addSql('ALTER TABLE tracks ADD album_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2E1137ABCF FOREIGN KEY (album_id) REFERENCES albums (id)');
        $this->addSql('CREATE INDEX IDX_246D2A2E1137ABCF ON tracks (album_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE albums DROP FOREIGN KEY FK_F4E2474FB7970CF8');
        $this->addSql('DROP INDEX IDX_F4E2474FB7970CF8 ON albums');
        $this->addSql('ALTER TABLE albums DROP artist_id');
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2E1137ABCF');
        $this->addSql('DROP INDEX IDX_246D2A2E1137ABCF ON tracks');
        $this->addSql('ALTER TABLE tracks DROP album_id');
    }
}
